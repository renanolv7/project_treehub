
// Dados e configuração para o Chart.js
const ctx = document.getElementById('donationChart').getContext('2d');
const donationChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        datasets: [{
            label: 'Doações',
            data: [5, 8, 12, 15, 17, 20, 22, 25, 26, 28, 29, 30],
            backgroundColor: 'rgba(0, 0, 0, 0.05)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 2,
            tension: 0.4, 
            pointRadius: 0, 
            fill: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false 
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: false, // Esconde as linhas de grade do eixo Y
                    drawBorder: false, // Esconde a borda do eixo Y
                },
                ticks: {
                    display: false // Esconde os rótulos do eixo Y
                }
            },
            x: {
                grid: {
                    display: false, // Esconde as linhas de grade do eixo X
                    drawBorder: false, // Esconde a borda do eixo X
                },
                ticks: {
                    display: false // Esconde os rótulos do eixo X
                }
            }
        }
    }
});


