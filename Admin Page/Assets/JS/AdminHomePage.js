const TRACK_URL = "visitPerDay.php";
const GET_URL = "getVisits.php";

// 2️⃣ On récupère les visites et on complète les jours manquants
async function fetchVisits() {
    try {
        const res = await fetch(GET_URL);
        const data = await res.json();

        // Crée un dictionnaire des visites par jour
        const visitsByDay = {};
        data.forEach(row => {
            visitsByDay[row.day] = parseInt(row.visites, 10);
        });

        // Génère les 30 derniers jours
        const labels = [];
        const values = [];
        for (let i = 29; i >= 0; i--) {
            const d = new Date();
            d.setDate(d.getDate() - i);
            const day = d.toISOString().slice(0, 10); // format YYYY-MM-DD
            labels.push(day);
            values.push(visitsByDay[day] || 0); // 0 si absent
        }

        return { labels, values };
    } catch (e) {
        console.error("Erreur lors de la récupération des visites :", e);
        return { labels: [], values: [] };
    }
}

// 3️⃣ On affiche le graphique
async function displayVisitsChart(canvasId) {
    const { labels, values } = await fetchVisits();

    const ctx = document.getElementById(canvasId).getContext('2d');
    new Chart(ctx, {
        type: 'line',  // type: line, bar, pie...
        data: {
            labels: labels,
            datasets: [{
                label: 'Visites par jour',
                data: values,
                fill: true,                  // Remplir sous la ligne
                borderColor: '#FF5733',      // Couleur de la ligne
                backgroundColor: 'rgba(255, 51, 51, 0.2)', // Couleur du remplissage
                tension: 0.4,                // Courbure de la ligne (0 = droite)
                pointStyle: 'circle',        // Forme des points
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#333',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: '#333',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + " visites";
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Jour',
                        color: '#333',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        color: '#333'
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    min: 0,
                    max: 50,
                    title: {
                        display: true,
                        text: 'Nombre de visites',
                        color: '#333',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        stepSize: 1,
                        color: '#333'
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                }
            }
        }
    });
}

// 4️⃣ Quand la page est chargée
document.addEventListener('DOMContentLoaded', async () => {
    await displayVisitsChart("visitsChart"); // affiche le graphique
});