import { materialRenderFunc } from '/app/web/js/view/graphRenderFunc/materialRenderFunc.js';
import { diameterRenderFunc } from '/app/web/js/view/graphRenderFunc/diameterRenderFunc.js';
import { measureRenderFunc } from '/app/web/js/view/graphRenderFunc/measureRenderFunc.js';

export class GraphRenderer {

  static handle(graphDataList) {
    const modes = graphDataList.map(d => d.mode);

    // canvas要素の更新処理
    this.#updateCanvases(modes);

    // グラフの描画処理
    graphDataList.forEach(graphData => {
      this.#renderGraph(graphData);
    });
  }

  static #renderGraph(graphData) {
    const canvas = this.#getCanvas(graphData.mode);

    const renderMap = {
      material: materialRenderFunc,
      diameter: diameterRenderFunc,
      measure: measureRenderFunc,
    };

    renderMap[graphData.mode]?.(canvas, graphData);
  }

  // 古いcanvas要素を削除して更新
  static #updateCanvases(modes) {
    const container = document.getElementById('chartContainer');

    container.querySelectorAll('canvas').forEach(canvas => {
      const mode = canvas.id.replace('chart-', '');
      if (!modes.includes(mode)) {
        // 指定のChartインスタンスがある場合のみdestroy(削除)する
        Chart.getChart(canvas)?.destroy();
        canvas.remove();
      }
    });
  }

  // canvas要素の作成・取得
  static #getCanvas(mode) {
    const container = document.getElementById('chartContainer');
    const canvasId = `chart-${mode}`;

    let canvas = document.getElementById(canvasId);

    if (!canvas) {
      canvas = document.createElement('canvas');
      canvas.id = canvasId;
      container.appendChild(canvas);
    } else {
      // 前回検索時に生成されたChartインスタンスを破棄
      Chart.getChart(canvas)?.destroy();
    }

    return canvas;
  }
}
