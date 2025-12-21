export class UIBehaviorManager {
  constructor() {
    // グラフ画面と検索画面の表示切替え
    this.#switchDisplayEvents();

    // 検索ページの動作を管理
    this.#searchPageEvents();
  }

  #switchDisplayEvents() {
    this.graphBtn = document.getElementById('graph-btn');
    this.searchBtn = document.getElementById('search-btn');

    this.graphContent = document.getElementById('graph-content');
    this.searchContent = document.getElementById('search-content');

    this.pairs = [
      { btn: this.graphBtn, el: this.graphContent },
      { btn: this.searchBtn, el: this.searchContent },
    ];
    this.pairs.forEach((pair) => {
      pair.btn.addEventListener("click", () => {
        const className = "checked";
        this.#toggleClass(pair, className);
      });
    });
  }

  #toggleClass(targetEl, className) {
    this.pairs.forEach((pair) => {
      pair.btn.classList.remove(className);
      pair.el.classList.remove(className);
    });

    targetEl.btn.classList.add(className);
    targetEl.el.classList.add(className);
  }

  #searchPageEvents() {
    //「3.対象製品」の選択ボタンの表示切替え処理
    this.#showProductFilter();
    // チェックボックスの全選択処理
    this.#selectCheckboxEvents();
  }

  #showProductFilter() {
    this.allBtn = document.getElementById('product-all');
    this.filterBtn = document.getElementById('product-filter');
    this.filterEl = document.querySelector('.filter-detail');

    this.filterBtn.addEventListener("click", () => {
      this.filterEl.classList.add("checked");
    });
    this.allBtn.addEventListener("click", () => {
      this.filterEl.classList.remove("checked");
    });
  }

  #selectCheckboxEvents() {
    // サイズ
    this.sizeAllEl = document.querySelector('.product-size input[value="all"]');
    this.sizeCheckboxes = document.querySelectorAll('.product-size input[type="checkbox"]');

    // 材質
    this.materialAllEl = document.querySelector('.product-material input[value="all"]');
    this.materialCheckboxes = document.querySelectorAll('.product-material input[type="checkbox"]');

    // 口径（Aサイズ）
    this.AdiameterAllEl = document.querySelector('.A-diameter input[value="all"]');
    this.AdiameterCheckboxes = document.querySelectorAll('.A-diameter input[type="checkbox"]');

    // 口径（Bサイズ）
    this.BdiameterAllEl = document.querySelector('.B-diameter input[value="all"]');
    this.BdiameterCheckboxes = document.querySelectorAll('.B-diameter input[type="checkbox"]');

    this.checkboxPairs = [
      { allEl: this.sizeAllEl, checkboxes: this.sizeCheckboxes },
      { allEl: this.materialAllEl, checkboxes: this.materialCheckboxes },
      { allEl: this.AdiameterAllEl, checkboxes: this.AdiameterCheckboxes },
      { allEl: this.BdiameterAllEl, checkboxes: this.BdiameterCheckboxes },
    ];

    this.checkboxPairs.forEach((checkboxPair) => {
      this.#allCheckboxEvents(checkboxPair.allEl, checkboxPair.checkboxes);
    });
  }

  #allCheckboxEvents(allEl, allCheckboxes) {
    // all以外のチェックボックス要素を抽出
    const checkboxes = [];
    allCheckboxes.forEach((checkbox) => {
      if (checkbox.value !== "all") {
        checkboxes.push(checkbox);
      }
    });

    // allを選択した時の挙動を定義
    allEl.addEventListener("click", () => {
      if (allEl.checked === true) {
        // allを選択 → 全部ONにする
        checkboxes.forEach(checkbox => checkbox.checked = true);
      } else {
        // allを解除 → 全部OFFにする
        checkboxes.forEach(checkbox => checkbox.checked = false);
      }
    });

    // 各チェックボックスの監視処理を定義
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener("click", () => {
        if (checkboxes.every(checkbox => checkbox.checked)) {
          // すべてのcheckboxが選択された → allを選択状態にする
          allEl.checked = true;
        } else {
          // 1つでもcheckboxの選択が外れた → allの選択状態を解除する
          allEl.checked = false;
        }
      });
    });
  }
}
