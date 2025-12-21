export class Translator {
  // サーバからのデータをグラフ化に適した形式に変換
  static translateToGraphRender(responseObjs) {
    const graphDataList = [];

    const measureDataList = ['measure'];
    const passDataList = ['material', 'diameter'];

    Object.entries(responseObjs).forEach(([mode, data]) => {
      console.log(mode);
      if (passDataList.includes(mode)) {
        graphDataList.push(this.#passTranslate(mode, data));
      }

      if (measureDataList.includes(mode)) {
        graphDataList.push(this.#measureTranslate(mode, data));
      }

      // graphDataList.push(graphDataObj);
    });
    console.log(graphDataList);
    return graphDataList;
  }

  // responseObjsのうち測定値の推移に関わるデータ変換を担当
  static #measureTranslate(mode, data) {
    const graphDataObj = {
      mode: mode,
      direction: 'one',
      labels: [],
      bfs_1: [],
      sfs_1: [],
    }
    console.log(data);

    data.forEach(value => {
      graphDataObj.labels.push(value.label);
      graphDataObj.bfs_1.push(value.bfs_1);
      graphDataObj.sfs_1.push(value.sfs_1);
    });
    console.log(graphDataObj);
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
    console.log(graphDataObj);
    return graphDataObj;
  }
}
