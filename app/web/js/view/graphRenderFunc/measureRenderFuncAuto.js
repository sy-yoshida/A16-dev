export function measureRenderFunc(ctx, graphData) {

    const sfsPoints = graphData.labels.map((t, i) => ({
        x: new Date(t).getTime(),   // ★ 数値（ms）
        y: graphData.sfs[i]
    }));

    const bfsPoints = graphData.labels.map((t, i) => ({
        x: new Date(t).getTime(),
        y: graphData.bfs[i]
    }));

    new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [
                {
                    label: '微漏れFS検出値 (SFS)',
                    data: sfsPoints,
                    yAxisID: 'ySfs',
                    parsing: false
                },
                {
                    label: '大漏れFS検出値 (BFS)',
                    data: bfsPoints,
                    yAxisID: 'yBfs',
                    parsing: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    type: 'time'
                },
                ySfs: {
                    position: 'left'
                },
                yBfs: {
                    position: 'right',
                    grid: { drawOnChartArea: false }
                }
            }
        }
    });
}


function toSafeDate(str) {
    // タイムゾーン付き → UTC に変換
    return new Date(str.replace(/([+-]\d\d):(\d\d)$/, '$1$2'));
}