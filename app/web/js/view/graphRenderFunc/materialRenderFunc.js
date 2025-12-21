// 材質別のグラフ描画の処理を定義
export function materialRenderFunc(ctx, graphData) {
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: graphData['labels'],
      datasets: [
        {
          // 生産台数のグラフに関する設定
          label: '生産台数（個）',
          data: graphData['productionCounts'],
          backgroundColor: 'rgba(54, 162, 235, 0.7)',
          barPercentage: 0.4,
          categoryPercentage: 0.6,
          yAxisID: 'y'
        },
        {
          // 良品率のグラフに関する設定
          label: '良品率（%）',
          data: graphData['passRates'],
          backgroundColor: 'rgba(249, 223, 77, 1)',
          barPercentage: 0.4,
          categoryPercentage: 0.6,
          yAxisID: 'y1'
        }
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          position: 'left',
          title: {
            display: true,
            text: '生産台数（個）'
          }
        },
        y1: {
          beginAtZero: true,
          position: 'right',
          min: 0,
          max: 100,
          ticks: {
            callback: (value) => value + '%'
          },
          grid: {
            drawOnChartArea: false
          },
          title: {
            display: true,
            text: '良品率（%）'
          }
        }
      }
    }
  });
}
