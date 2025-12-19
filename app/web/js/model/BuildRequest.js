export class BuildRequest {
    constructor(formEl) {
        this.formEl = formEl;
    }

    handle() {
        const requestObj =this.#toRequestObj();
        return this.#encodeJson(requestObj);
    }

    // HTMLの入力データをオブジェクトへ格納
    #toRequestObj() {
        const requestObj = {};

        // FormDataインスタンスを使用してinputタグの入力データを取得
        const formData = new FormData(this.formEl);

        // 【日付データの入力値を取得】
        // ISO8601形式への変換
        requestObj.startDate = this.#toIso8601Time(
            formData.get('start_date[day]'),
            formData.get('start_date[hour]'),
            formData.get('start_date[minute]')
        );

        requestObj.endDate = this.#toIso8601Time(
            formData.get('end_date[day]'),
            formData.get('end_date[hour]'),
            formData.get('end_date[minute]')
        );

        // 【検査機検索の入力値を取得】
        const machine = formData.getAll('machine[]');
        if (machine.length > 0) {
            requestObj.machines = machine;
        }

        // 対象製品の選択データを配列で取得
        // 「すべて選択(all)」か「条件選択(filter)」かを取得
        requestObj.product = {
            mode: formData.get('product[choice]')
        }

        // 条件選択の詳細入力情報を取得して配列に格納
        const productFiltersObj = {};
        if (requestObj.product.mode !== 'all') {
            const size = formData.getAll('product[size]');
            if (size.length > 0) {
                productFiltersObj.sizes = size;
            }

            const material = formData.getAll('product[material]');
            if (material.length > 0) {
                productFiltersObj.materials = material;
            }

            const Adiameter = formData.getAll('product[A-diameter]');
            if (Adiameter.length > 0) {
                productFiltersObj.Adiameters = Adiameter;
            }

            const Bdiameter = formData.getAll('product[B-diameter]');
            if (Bdiameter.length > 0) {
                productFiltersObj.Bdiameters = Bdiameter;
            }

            requestObj.product.filter = productFiltersObj;
        }

        console.log(requestObj);
        return requestObj;
    }

    #encodeJson(requestObj) {
        return JSON.stringify(requestObj);
    }

    // 国際的な時刻形式であるISO8601に入力の時刻データを変換
    // （ブラウザ / サーバ間のデータ形式を統一するため変換）
    #toIso8601Time(day, hour, minute) {
        const h = String(hour).padStart(2, '0');
        const m = String(minute).padStart(2, '0');
        return `${day}T${h}:${m}:00+09:00`;
    }

    // 検査条件の製品データを組み立てるメソッド
    // 5~20サイズは口径はA(ミリメートル)指定、150はB(インチ)指定でリクエストを送る
    
}