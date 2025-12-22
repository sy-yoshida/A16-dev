export function measureRenderFunc(ctx, graphData) {
    const start = new Date(graphData.startDate).getTime();
    const end   = new Date(graphData.endDate).getTime();

    const timeScale = getTimeScaleOptions(start, end);

    const sfsPoints = graphData.labels.map((t, i) => ({
        x: new Date(t).getTime(),
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
                    type: 'time',
                    min: start,
                    max: end,
                    time: timeScale,
                    ticks: {
                        autoSkip: false   // ← 刻み通り全部表示したい場合
                    }
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


function getTimeScaleOptions(start, end) {
    const diffMs = end - start;
    const diffMinutes = diffMs / (1000 * 60);
    const diffHours = diffMinutes / 60;
    console.log(diffHours);

    if (diffHours <= 2) {
        return {
            unit: 'minute',
            stepSize: 10,
            displayFormats: {
                minute: 'HH:mm'
            }
        };
    }

    if (diffHours <= 8) {
        return {
            unit: 'minute',
            stepSize: 30,
            displayFormats: {
                minute: 'HH:mm'
            }
        };
    }

    if (diffHours <= 48) {
        return {
            unit: 'hour',
            stepSize: 1,
            displayFormats: {
                hour: 'MM/dd HH:mm'
            }
        };
    }

    return {
        unit: 'day',
        stepSize: 1,
        displayFormats: {
            day: 'MM/dd'
        }
    };
}

