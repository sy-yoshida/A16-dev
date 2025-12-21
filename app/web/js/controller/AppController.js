import { UIBehaviorManager } from "/app/web/js/view/UIBehaviorManager.js";
import { FormValidator } from "/app/web/js/model/FormValidator.js";
import { BuildRequest } from "/app/web/js/model/BuildRequest.js";
import { Fetch } from "/app/web/js/model/Fetch.js";
import { Translator } from "/app/web/js/model/Translator.js";
import { GraphRenderer } from "/app/web/js/view/GraphRenderer.js";

export class AppController {
  constructor() {
    this.formEl = document.getElementById('dataForm');

    new UIBehaviorManager();
    this.formValidator = new FormValidator(this.formEl);
    this.BuildRequest = new BuildRequest(this.formEl);
  }

  run() {
    this.#userSearch();
  }

  #userSearch() {
    this.formEl.addEventListener("submit", async (e) => {
      e.preventDefault();
      this.formValidator.handle();
      const jsonRequest = this.BuildRequest.handle();
      const responseObjs = await Fetch.userRequest(jsonRequest);
      const graphDataList = Translator.translateToGraphRender(responseObjs);
      GraphRenderer.handle(graphDataList);
    })
  }
}
