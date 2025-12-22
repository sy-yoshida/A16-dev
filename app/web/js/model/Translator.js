export class Translator {
  // サーバからのデータをグラフ化に適した形式に変換
  static translateToGraphRender(responseObjs) {
    const graphDataList = [];
    console.log(responseObjs);

    const measureDataList = ['measure'];
    const passDataList = ['material', 'diameter'];
    Object.entries(responseObjs).forEach(([mode, data]) => {
      if (passDataList.includes(mode)) {
        graphDataList.push(this.#passTranslate(mode, data));
      }

      if (measureDataList.includes(mode)) {
        graphDataList.push(this.#measureTranslate(mode, data));
      }

      // graphDataList.push(graphDataObj);
    });
    return graphDataList;
  }

  // responseObjsのうち測定値の推移に関わるデータ変換を担当
  static #measureTranslate(mode, data) {
    const graphDataObj = {
      mode: mode,
      startDate: data.metadata.startDate,
      endDate: data.metadata.endDate,
      labels: [],
      bfs: [],
      sfs: [],
    }

    data.body.forEach(value => {
      graphDataObj.labels.push(value.label);
      graphDataObj.bfs.push(value.bfs);
      graphDataObj.sfs.push(value.sfs);
    });
    return graphDataObj;
  }

  // responseObjsのうち良品率に関わるデータの変換を担当
  static #passTranslate(mode, data) {
    const graphDataObj = {
      mode: mode,
      labels: [],
      productionCounts: [],
      passRates: [],
    };

    data.forEach(value => {
      graphDataObj.labels.push(value.label);
      graphDataObj.productionCounts.push(value.production_count);
      graphDataObj.passRates.push(value.pass_rate);
    });
    return graphDataObj;
  }
}
