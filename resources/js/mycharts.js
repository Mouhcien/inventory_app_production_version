import Chart from 'chart.js/auto';

function firstChart() {
    let total_employees = document.getElementById('txt_total_employees').value;
    let total_materials = document.getElementById('txt_total_materials').value;
    var ctx = document.getElementById('mainChart').getContext('2d');
    var mainChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Equipements', 'Employés'],
            datasets: [{
                label: 'Coordination entre les équipements et les employés',
                data: [total_materials, total_employees],
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(0, 0, 255, 0.2)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function secondChart() {
    let total_employees = document.getElementById('txt_total_employees').value;
    let total_pc = document.getElementById('txt_total_pc').value;
    let total_printer = document.getElementById('txt_total_printer').value;
    var ctx = document.getElementById('secondChart').getContext('2d');
    var secondChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['PCs Fixe', 'Imprimantes', 'Employés'],
            datasets: [{
                label: 'Coordination entre les équipements et les employés',
                data: [total_pc, total_printer,  total_employees],
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(10, 123, 255, 0.2)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function thirdChart() {
    let total_materials = document.getElementById('txt_total_materials').value;
    let total_inventory = document.getElementById('txt_total_inventory').value;
    var ctx = document.getElementById('invMainChart').getContext('2d');
    var thirdChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Inventaire', 'Equipements'],
            datasets: [{
                label: "Coordination entre les équipements et l'inventaire",
                data: [total_inventory, total_materials],
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(50, 233, 120, 0.5)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function fourthChart() {
    let total_pc = document.getElementById('txt_total_pc').value;
    let total_printer = document.getElementById('txt_total_printer').value;
    let total_laptops = document.getElementById('txt_total_laptop').value;
    let total_scanner = document.getElementById('txt_total_scanner').value;
    let total_big_printers = document.getElementById('txt_total_big_printer').value;
    var ctx = document.getElementById('materialTypeChart').getContext('2d');
    var materialTypeChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['PCs Fixe', 'PCs Portable', 'Imprimantes', 'Photocopies', 'Scanners'],
            datasets: [{
                label: "Coordination entre les types équipements",
                data: [total_pc, total_laptops, total_printer, total_big_printers, total_scanner ],
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(70, 155, 60, 0.4)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function chartBrokeDamageMaterial() {
    let notAffetced = document.getElementById('txt_not_affetcted').value;
    let broke = document.getElementById('txt_total_broke').value;
    let damage = document.getElementById('txt_total_damage').value;
    var ctx = document.getElementById('chartBrokeDamageMaterial').getContext('2d');
    var chartBrokeDamageMaterial = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Non Affecté', 'En Panne', 'En Casse'],
            datasets: [{
                label: "Les équipements avec des problèmes",
                data: [notAffetced, broke, damage],
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(30, 200, 60, 0.4)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


window.onload = function() {
    firstChart();
    secondChart();
    thirdChart();
    fourthChart();
    chartBrokeDamageMaterial();
};
