export class FormValidator {
    constructor(formEl) {
        this.formEl = formEl;
    }

    handle() {
        const formData = new FormData(this.formEl);

        // 日付データが未入力でないか確認
        this.#validateDate(formData.get('start_date[day]'));
        this.#validateDate(formData.get('end_date[day]'));
    }

    #validateDate(day) {
        // 未入力の処理を記述すること
        if (this.#isBlank(day)) {
            console.log('validate error');
        }
    }

    #isBlank(value) {
        return value === '' || value === null || value === undefined;
    }
}