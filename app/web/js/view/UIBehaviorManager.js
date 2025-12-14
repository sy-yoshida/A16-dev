export class UIBehaviorManager {
  constructor() {
    this.graphBtn = document.getElementById('graph-btn');
    this.settingBtn = document.getElementById('setting-btn');

    this.graphContent = document.getElementById('graph-content');
    this.settingContent = document.getElementById('setting-content');

    this.pairs = [
      { btn: this.graphBtn, el: this.graphContent },
      { btn: this.settingBtn, el: this.settingContent },
    ];

    this.#initEvents();
  }

  #initEvents() {
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
}
