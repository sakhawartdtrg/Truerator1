document.addEventListener("DOMContentLoaded", () => {
    let t = null;
    if (t = document.getElementById("sortable-style-1"), t) {
        Sortable.create(t, {animation: 150})
    }
    if (t = document.getElementById("sortable-style-2"), t) {
        Sortable.create(t, {
            handle: ".handle",
            animation: 150
        })
    }
    if (t = document.getElementById("sortable-style-3"), t) {
        Sortable.create(t, {animation: 150})
    }
    const e = document.getElementById("ckeditor");
    e && ClassicEditor.create(e);
    const o = document.getElementById("carousel-style-1");
    o && new Glide(o, {
        type: "carousel",
        perView: 4,
        gap: 20,
        breakpoints: {
            640: {
                perView: 1
            },
            768: {
                perView: 2
            }
        }
    }).mount()
});
const on = (t, e, o, a) => {
        const r = document.querySelectorAll(t);
        for (element of r)
            element.addEventListener(e, t => {
                t.target.closest(o) && a(t)
            })

    },
    animateCSS = (t, e, o) => {
        t.classList.add("animated", "faster", e);
        const a = () => {
            t.classList.remove("animated", "faster", e),
            t.removeEventListener("animationend", a),
            "function" == typeof o && o()
        };
        t.addEventListener("animationend", a)
    },
    animateNode = (t, e) => {
        const o = () => {
            t.removeEventListener("transitionend", o),
            "function" == typeof e && e()
        };
        t.addEventListener("transitionend", o)
    },
    toggleCardSelection = t => {
        t.target.closest(".card").classList.toggle("card_selected")
    };
on("body", "click", '[data-toggle="cardSelection"]', t => {
    toggleCardSelection(t)
});
const toggleRowSelection = t => {
    t.target.closest("tr").classList.toggle("row_selected")
};
let viewportWidth;
on("body", "click", '[data-toggle="rowSelection"]', t => {
    toggleRowSelection(t)
});
const setViewportWidth = () => {
        viewportWidth = window.innerWidth || document.documentElement.clientWidth
    },
    watchWidth = () => {
        const t = document.querySelector(".menu-bar");
        viewportWidth < 640 ? t.classList.contains("open") || (t.classList.add("menu-hidden"), document.documentElement.classList.add("menu-hidden")) : viewportWidth < 768 && (t.classList.remove("menu-hidden"), document.documentElement.classList.remove("menu-hidden"))
    };
setViewportWidth(),
watchWidth(),
window.addEventListener("resize", () => {
    setViewportWidth(),
    watchWidth()
}, !1);
const showActivePage = () => {
    const t = window.location.href.split(/[?#]/)[0],
        e = document.querySelectorAll(".menu-bar a");
    e && e.forEach(e => {
        if (e.href === t) {
            e.classList.add("active");
            const t = e.closest(".menu-detail");
            if (! t)
                return;

            document.querySelector('.menu-items .link[data-target="' + t.dataset.menu + '"]').classList.add("active")
        }
    })
};
showActivePage();
const alerts = () => {
    on(".alert", "click", '[data-dismiss="alert"]', t => {
        (t => {
            animateCSS(t, "fadeOut", () => {
                t.style.transition = "all .2s linear",
                t.style.opacity = 0,
                t.style.height = t.scrollHeight + "px",
                setTimeout(() => {
                    t.style.height = 0,
                    t.style.margin = 0,
                    t.style.padding = 0
                }),
                animateNode(t, () => {
                    t.parentNode.removeChild(t)
                })
            })
        })(t.target.closest(".alert"))
    })
};
if (alerts(), "undefined" != typeof Chart) {
    let t = {
        primary: "20, 83, 136"
    };
    const e = {
        backgroundColor: "#ffffff",
        titleFontColor: "rgba(" + t.primary + ")",
        borderColor: "#dddddd",
        borderWidth: .5,
        bodyFontColor: "#555555",
        bodySpacing: 8,
        xPadding: 16,
        yPadding: 16,
        cornerRadius: 4,
        displayColors: !0
    };
    Chart.defaults.global.defaultFontFamily = "'Nunito Sans', sans-serif",
    Chart.defaults.global.defaultFontColor = "#555555";
    let o = "";
    const a = Chart.elements.Line.extend({
        draw: function () {
            const {ctx: t} = this._chart,
                e = t.stroke;
            t.stroke = function () {
                t.save(),
                t.shadowColor = "rgba(0, 0, 0, 0.25)",
                t.shadowBlur = 8,
                t.shadowOffsetX = 0,
                t.shadowOffsetY = 4,
                e.apply(this, arguments),
                t.restore()
            },
            Chart.elements.Line.prototype.draw.apply(this, arguments),
            t.stroke = e
        }
    });
    Chart.defaults.lineWithShadow = Chart.defaults.line,
    Chart.controllers.lineWithShadow = Chart.controllers.line.extend({datasetElementType: a}),
    Chart.defaults.radarWithShadow = Chart.defaults.radar,
    Chart.controllers.radarWithShadow = Chart.controllers.radar.extend({datasetElementType: a}),
    Chart.defaults.barWithShadow = Chart.defaults.bar,
    Chart.defaults.global.datasets.barWithShadow = Chart.defaults.global.datasets.bar,
    Chart.controllers.barWithShadow = Chart.controllers.bar.extend({
        draw: function (t) {
            Chart.controllers.bar.prototype.draw.call(this, t);
            const e = this.chart.ctx;
            e.save(),
            e.shadowColor = "rgba(0, 0, 0, 0.25)",
            e.shadowBlur = 8,
            e.shadowOffsetX = 0,
            e.shadowOffsetY = 4,
            Chart.controllers.bar.prototype.draw.apply(this, arguments),
            e.restore()
        }
    }),
    Chart.defaults.pieWithShadow = Chart.defaults.pie,
    Chart.controllers.pieWithShadow = Chart.controllers.pie.extend({
        draw: function (t) {
            Chart.controllers.pie.prototype.draw.call(this, t);
            const e = this.chart.ctx;
            e.save(),
            e.shadowColor = "rgba(0, 0, 0, 0.25)",
            e.shadowBlur = 8,
            e.shadowOffsetX = 0,
            e.shadowOffsetY = 4,
            Chart.controllers.pie.prototype.draw.apply(this, arguments),
            e.restore()
        }
    }),
    Chart.defaults.doughnutWithShadow = Chart.defaults.doughnut,
    Chart.controllers.doughnutWithShadow = Chart.controllers.doughnut.extend({
        draw: function (t) {
            Chart.controllers.doughnut.prototype.draw.call(this, t);
            const e = this.chart.ctx;
            e.save(),
            e.shadowColor = "rgba(0, 0, 0, 0.25)",
            e.shadowBlur = 8,
            e.shadowOffsetX = 0,
            e.shadowOffsetY = 4,
            Chart.controllers.doughnut.prototype.draw.apply(this, arguments),
            e.restore()
        }
    }),
    Chart.defaults.polarAreaWithShadow = Chart.defaults.polarArea,
    Chart.controllers.polarAreaWithShadow = Chart.controllers.polarArea.extend({
        draw: function (t) {
            Chart.controllers.polarArea.prototype.draw.call(this, t);
            const e = this.chart.ctx;
            e.save(),
            e.shadowColor = "rgba(0, 0, 0, 0.25)",
            e.shadowBlur = 8,
            e.shadowOffsetX = 0,
            e.shadowOffsetY = 4,
            Chart.controllers.polarArea.prototype.draw.apply(this, arguments),
            e.restore()
        }
    }),
    Chart.defaults.lineWithAnnotation = Chart.defaults.line,
    Chart.controllers.lineWithAnnotation = Chart.controllers.line.extend({
        draw: function (t) {
            if (Chart.controllers.line.prototype.draw.call(this, t), this.chart.tooltip._active && this.chart.tooltip._active.length) {
                const t = this.chart.tooltip._active[0],
                    e = this.chart.ctx,
                    o = t.tooltipPosition().x,
                    a = this.chart.scales["y-axis-0"].top,
                    r = this.chart.scales["y-axis-0"].bottom;
                e.save(),
                e.beginPath(),
                e.moveTo(o, a),
                e.lineTo(o, r),
                e.lineWidth = 1,
                e.strokeStyle = "rgba(0,0,0,0.1)",
                e.stroke(),
                e.restore()
            }
        }
    }),
    Chart.defaults.lineWithAnnotationAndShadow = Chart.defaults.line,
    Chart.controllers.lineWithAnnotationAndShadow = Chart.controllers.line.extend({
        draw: function (t) {
            if (Chart.controllers.line.prototype.draw.call(this, t), this.chart.tooltip._active && this.chart.tooltip._active.length) {
                const t = this.chart.tooltip._active[0],
                    e = this.chart.ctx,
                    o = t.tooltipPosition().x,
                    a = this.chart.scales["y-axis-0"].top,
                    r = this.chart.scales["y-axis-0"].bottom;
                e.save(),
                e.beginPath(),
                e.moveTo(o, a),
                e.lineTo(o, r),
                e.lineWidth = 1,
                e.strokeStyle = "rgba(0,0,0,0.1)",
                e.stroke(),
                e.restore()
            }
        },
        datasetElementType: a
    });
    const r = {
            afterInit: function (t, e) {
                const o = t.canvas.parentNode,
                    a = t.data.datasets[0].data[0],
                    r = t.data.datasets[0].label,
                    i = t.data.labels[0];
                o.querySelector(".chart-value").innerHTML = "$" + a.toLocaleString(),
                o.querySelector(".chart-label").innerHTML = r + ": " + i
            }
        },
        i = {
            layout: {
                padding: {
                    left: 5,
                    right: 5,
                    top: 10,
                    bottom: 10
                }
            },
            responsive: !0,
            legend: {
                display: !1
            },
            tooltips: {
                intersect: !1,
                enabled: !1,
                custom: function (t) {
                    if (t && t.dataPoints) {
                        const e = this._chart.canvas.parentNode,
                            o = t.dataPoints[0].yLabel,
                            a = t.body[0].lines[0].split(":")[0],
                            r = t.dataPoints[0].xLabel;
                        e.querySelector(".chart-value").innerHTML = "$" + o.toLocaleString(),
                        e.querySelector(".chart-label").innerHTML = a + ": " + r
                    }
                }
            },
            scales: {
                yAxes: [
                    {
                        display: !1
                    }
                ],
                xAxes: [
                    {
                        display: !1
                    }
                ]
            }
        };
    if (o = document.getElementById("areaChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "line",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June"
                ],
                datasets: [
                    {
                        backgroundColor: "rgba(" + t.primary + ", .1)",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 4,
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        pointHoverBorderWidth: 2,
                        data: [
                            5,
                            10,
                            15,
                            10,
                            15,
                            10
                        ]
                    }
                ]
            },
            options: {
                legend: !1,
                tooltips: e,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: !0,
                                drawBorder: !1
                            },
                            ticks: {
                                stepSize: 5,
                                min: 0,
                                max: 20
                            }
                        }
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: !1
                            }
                        }
                    ]
                }
            }
        })
    }
    if (o = document.getElementById("areaWithShadowChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithShadow",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June"
                ],
                datasets: [
                    {
                        backgroundColor: "rgba(" + t.primary + ", .1)",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 4,
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        pointHoverBorderWidth: 2,
                        data: [
                            5,
                            10,
                            15,
                            10,
                            15,
                            10
                        ]
                    }
                ]
            },
            options: {
                legend: !1,
                tooltips: e,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: !0,
                                drawBorder: !1
                            },
                            ticks: {
                                stepSize: 5,
                                min: 0,
                                max: 20
                            }
                        }
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: !1
                            }
                        }
                    ]
                }
            }
        })
    }
    if (o = document.getElementById("lineChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "line",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June"
                ],
                datasets: [
                    {
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 6,
                        pointBorderWidth: 2,
                        pointHoverRadius: 8,
                        pointHoverBorderWidth: 2,
                        fill: !1,
                        data: [
                            5,
                            10,
                            15,
                            10,
                            15,
                            10
                        ]
                    }
                ]
            },
            options: {
                legend: !1,
                tooltips: e,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: !0,
                                drawBorder: !1
                            },
                            ticks: {
                                stepSize: 5,
                                min: 0,
                                max: 20
                            }
                        }
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: !1
                            }
                        }
                    ]
                }
            }
        })
    }
    if (o = document.getElementById("lineWithShadowChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithShadow",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June"
                ],
                datasets: [
                    {
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 6,
                        pointBorderWidth: 2,
                        pointHoverRadius: 8,
                        pointHoverBorderWidth: 2,
                        fill: !1,
                        data: [
                            5,
                            10,
                            15,
                            10,
                            15,
                            10
                        ]
                    }
                ]
            },
            options: {
                legend: !1,
                tooltips: e,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: !0,
                                drawBorder: !1
                            },
                            ticks: {
                                stepSize: 5,
                                min: 0,
                                max: 20
                            }
                        }
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: !1
                            }
                        }
                    ]
                }
            }
        })
    }
    if (o = document.getElementById("barChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "bar",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June"
                ],
                datasets: [
                    {
                        label: "Potatoes",
                        backgroundColor: "rgba(" + t.primary + ", .1)",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [
                            5,
                            10,
                            15,
                            10,
                            15,
                            10
                        ]
                    }, {
                        label: "Tomatoes",
                        backgroundColor: "rgba(" + t.primary + ", .5)",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [
                            7.5,
                            10,
                            17.5,
                            15,
                            12.5,
                            5
                        ]
                    }
                ]
            },
            options: {
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: !0,
                                drawBorder: !1
                            },
                            ticks: {
                                stepSize: 5,
                                min: 0,
                                max: 20
                            }
                        }
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: !1
                            }
                        }
                    ]
                }
            }
        })
    }
    if (o = document.getElementById("barWithShadowChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "barWithShadow",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June"
                ],
                datasets: [
                    {
                        label: "Potatoes",
                        backgroundColor: "rgba(" + t.primary + ", .1)",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [
                            5,
                            10,
                            15,
                            10,
                            15,
                            10
                        ]
                    }, {
                        label: "Tomatoes",
                        backgroundColor: "rgba(" + t.primary + ", .5)",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [
                            7.5,
                            10,
                            17.5,
                            15,
                            12.5,
                            5
                        ]
                    }
                ]
            },
            options: {
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: !0,
                                drawBorder: !1
                            },
                            ticks: {
                                stepSize: 5,
                                min: 0,
                                max: 20
                            }
                        }
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: !1
                            }
                        }
                    ]
                }
            }
        })
    }
    if (o = document.getElementById("pieChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "pie",
            data: {
                labels: [
                    "Potatoes", "Tomatoes", "Onions"
                ],
                datasets: [
                    {
                        backgroundColor: [
                            "rgba(" + t.primary + ", .1)",
                            "rgba(" + t.primary + ", .5)",
                            "rgba(" + t.primary + ", .25)"
                        ],
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [25, 10, 15]
                    }
                ]
            },
            options: {
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e
            }
        })
    }
    if (o = document.getElementById("pieWithShadowChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "pieWithShadow",
            data: {
                labels: [
                    "Potatoes", "Tomatoes", "Onions"
                ],
                datasets: [
                    {
                        backgroundColor: [
                            "rgba(" + t.primary + ", .1)",
                            "rgba(" + t.primary + ", .5)",
                            "rgba(" + t.primary + ", .25)"
                        ],
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [25, 10, 15]
                    }
                ]
            },
            options: {
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e
            }
        })
    }
    if (o = document.getElementById("doughnutChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "doughnut",
            data: {
                labels: [
                    "Potatoes", "Tomatoes", "Onions"
                ],
                datasets: [
                    {
                        backgroundColor: [
                            "rgba(" + t.primary + ", .1)",
                            "rgba(" + t.primary + ", .5)",
                            "rgba(" + t.primary + ", .25)"
                        ],
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [25, 10, 15]
                    }
                ]
            },
            options: {
                cutoutPercentage: 75,
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e
            }
        })
    }
    if (o = document.getElementById("doughnutWithShadowChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "doughnutWithShadow",
            data: {
                labels: [
                    "Potatoes", "Tomatoes", "Onions"
                ],
                datasets: [
                    {
                        backgroundColor: [
                            "rgba(" + t.primary + ", .1)",
                            "rgba(" + t.primary + ", .5)",
                            "rgba(" + t.primary + ", .25)"
                        ],
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [25, 10, 15]
                    }
                ]
            },
            options: {
                cutoutPercentage: 75,
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e
            }
        })
    }
    if (o = document.getElementById("polarChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "polarArea",
            data: {
                labels: [
                    "Potatoes", "Tomatoes", "Onions"
                ],
                datasets: [
                    {
                        backgroundColor: [
                            "rgba(" + t.primary + ", .1)",
                            "rgba(" + t.primary + ", .5)",
                            "rgba(" + t.primary + ", .25)"
                        ],
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [25, 10, 15]
                    }
                ]
            },
            options: {
                layout: {
                    padding: 5
                },
                scale: {
                    ticks: {
                        display: !1
                    }
                },
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e
            }
        })
    }
    if (o = document.getElementById("polarWithShadowChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "polarAreaWithShadow",
            data: {
                labels: [
                    "Potatoes", "Tomatoes", "Onions"
                ],
                datasets: [
                    {
                        backgroundColor: [
                            "rgba(" + t.primary + ", .1)",
                            "rgba(" + t.primary + ", .5)",
                            "rgba(" + t.primary + ", .25)"
                        ],
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [25, 10, 15]
                    }
                ]
            },
            options: {
                layout: {
                    padding: 5
                },
                scale: {
                    ticks: {
                        display: !1
                    }
                },
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e
            }
        })
    }
    if (o = document.getElementById("radarChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "radar",
            data: {
                labels: [
                    "Drinks", "Snacks", "Lunch", "Dinner"
                ],
                datasets: [
                    {
                        label: "Potatoes",
                        data: [
                            25, 25, 25, 25
                        ],
                        backgroundColor: "rgba(" + t.primary + ", .1)",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 4,
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        pointHoverBorderWidth: 2
                    }, {
                        label: "Tomatoes",
                        data: [
                            10,
                            10,
                            0,
                            20,
                            20
                        ],
                        backgroundColor: "rgba(" + t.primary + ", .25",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 4,
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        pointHoverBorderWidth: 2
                    }
                ]
            },
            options: {
                scale: {
                    ticks: {
                        display: !1,
                        max: 30
                    }
                },
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e
            }
        })
    }
    if (o = document.getElementById("radarWithShadowChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "radarWithShadow",
            data: {
                labels: [
                    "Drinks", "Snacks", "Lunch", "Dinner"
                ],
                datasets: [
                    {
                        label: "Potatoes",
                        data: [
                            25, 25, 25, 25
                        ],
                        backgroundColor: "rgba(" + t.primary + ", .1)",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 4,
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        pointHoverBorderWidth: 2
                    }, {
                        label: "Tomatoes",
                        data: [
                            10,
                            10,
                            0,
                            20,
                            20
                        ],
                        backgroundColor: "rgba(" + t.primary + ", .25",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 4,
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        pointHoverBorderWidth: 2
                    }
                ]
            },
            options: {
                scale: {
                    ticks: {
                        display: !1,
                        max: 30
                    }
                },
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e
            }
        })
    }
    if (o = document.getElementById("lineWithAnnotationChart1"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithAnnotation",
            plugins: [r],
            data: {
                labels: [
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat",
                    "Sun"
                ],
                datasets: [
                    {
                        label: "Total Orders",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 2,
                        pointBorderWidth: 4,
                        pointHoverRadius: 2,
                        fill: !1,
                        data: [
                            1250,
                            1300,
                            1550,
                            900,
                            1800,
                            1100,
                            1600
                        ]
                    }
                ]
            },
            options: i
        })
    }
    if (o = document.getElementById("lineWithAnnotationChart2"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithAnnotation",
            plugins: [r],
            data: {
                labels: [
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat",
                    "Sun"
                ],
                datasets: [
                    {
                        label: "Active Orders",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 2,
                        pointBorderWidth: 4,
                        pointHoverRadius: 2,
                        fill: !1,
                        data: [
                            100,
                            150,
                            300,
                            200,
                            100,
                            50,
                            50
                        ]
                    }
                ]
            },
            options: i
        })
    }
    if (o = document.getElementById("lineWithAnnotationChart3"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithAnnotation",
            plugins: [r],
            data: {
                labels: [
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat",
                    "Sun"
                ],
                datasets: [
                    {
                        label: "Pending Orders",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 2,
                        pointBorderWidth: 4,
                        pointHoverRadius: 2,
                        fill: !1,
                        data: [
                            350,
                            400,
                            750,
                            900,
                            600,
                            50,
                            50
                        ]
                    }
                ]
            },
            options: i
        })
    }
    if (o = document.getElementById("lineWithAnnotationChart4"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithAnnotation",
            plugins: [r],
            data: {
                labels: [
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat",
                    "Sun"
                ],
                datasets: [
                    {
                        label: "Shipped Orders",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 2,
                        pointBorderWidth: 4,
                        pointHoverRadius: 2,
                        fill: !1,
                        data: [
                            200,
                            400,
                            250,
                            600,
                            100,
                            50,
                            50
                        ]
                    }
                ]
            },
            options: i
        })
    }
    if (o = document.getElementById("lineWithAnnotationAndShadowChart1"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithAnnotationAndShadow",
            plugins: [r],
            data: {
                labels: [
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat",
                    "Sun"
                ],
                datasets: [
                    {
                        label: "Total Orders",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 2,
                        pointBorderWidth: 4,
                        pointHoverRadius: 2,
                        fill: !1,
                        data: [
                            1250,
                            1300,
                            1550,
                            900,
                            1800,
                            1100,
                            1600
                        ]
                    }
                ]
            },
            options: i
        })
    }
    if (o = document.getElementById("lineWithAnnotationAndShadowChart2"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithAnnotationAndShadow",
            plugins: [r],
            data: {
                labels: [
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat",
                    "Sun"
                ],
                datasets: [
                    {
                        label: "Active Orders",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 2,
                        pointBorderWidth: 4,
                        pointHoverRadius: 2,
                        fill: !1,
                        data: [
                            100,
                            150,
                            300,
                            200,
                            100,
                            50,
                            50
                        ]
                    }
                ]
            },
            options: i
        })
    }
    if (o = document.getElementById("lineWithAnnotationAndShadowChart3"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithAnnotationAndShadow",
            plugins: [r],
            data: {
                labels: [
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat",
                    "Sun"
                ],
                datasets: [
                    {
                        label: "Pending Orders",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 2,
                        pointBorderWidth: 4,
                        pointHoverRadius: 2,
                        fill: !1,
                        data: [
                            350,
                            400,
                            750,
                            900,
                            600,
                            50,
                            50
                        ]
                    }
                ]
            },
            options: i
        })
    }
    if (o = document.getElementById("lineWithAnnotationAndShadowChart4"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithAnnotationAndShadow",
            plugins: [r],
            data: {
                labels: [
                    "Mon",
                    "Tue",
                    "Wed",
                    "Thu",
                    "Fri",
                    "Sat",
                    "Sun"
                ],
                datasets: [
                    {
                        label: "Shipped Orders",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 2,
                        pointBorderWidth: 4,
                        pointHoverRadius: 2,
                        fill: !1,
                        data: [
                            200,
                            400,
                            250,
                            600,
                            100,
                            50,
                            50
                        ]
                    }
                ]
            },
            options: i
        })
    }
    if (o = document.getElementById("visitorsChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "lineWithShadow",
            data: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June"
                ],
                datasets: [
                    {
                        backgroundColor: "rgba(" + t.primary + ", .1)",
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        pointBackgroundColor: "#ffffff",
                        pointBorderColor: "rgba(" + t.primary + ")",
                        pointHoverBackgroundColor: "rgba(" + t.primary + ")",
                        pointHoverBorderColor: "#ffffff",
                        pointRadius: 4,
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        pointHoverBorderWidth: 2,
                        data: [
                            5,
                            10,
                            15,
                            10,
                            15,
                            10
                        ]
                    }
                ]
            },
            options: {
                legend: !1,
                tooltips: e,
                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: !0,
                                drawBorder: !1
                            },
                            ticks: {
                                stepSize: 5,
                                min: 0,
                                max: 20
                            }
                        }
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: !1
                            }
                        }
                    ]
                }
            }
        })
    }
    if (o = document.getElementById("categoriesChart"), o) {
        o.getContext("2d");
        new Chart(o, {
            type: "polarAreaWithShadow",
            data: {
                labels: [
                    "Potatoes", "Tomatoes", "Onions"
                ],
                datasets: [
                    {
                        backgroundColor: [
                            "rgba(" + t.primary + ", .1)",
                            "rgba(" + t.primary + ", .5)",
                            "rgba(" + t.primary + ", .25)"
                        ],
                        borderColor: "rgba(" + t.primary + ")",
                        borderWidth: 2,
                        data: [25, 10, 15]
                    }
                ]
            },
            options: {
                layout: {
                    padding: 5
                },
                scale: {
                    ticks: {
                        display: !1
                    }
                },
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: !0,
                        padding: 20
                    }
                },
                tooltips: e
            }
        })
    }
}
const collapse = () => {
    const t = t => {
        const e = t.target;
        e.classList.toggle("active");
        const o = t => {
            t.style.overflow = "hidden";
            const e = t.scrollHeight + "px";
            t.style.height = e,
            setTimeout(() => {
                t.style.height = 0,
                t.style.opacity = 0
            }, 200),
            animateNode(t, () => {
                t.style.removeProperty("overflow"),
                t.style.removeProperty("height"),
                t.style.removeProperty("opacity"),
                t.classList.remove("open")
            })
        };
        document.querySelectorAll(e.dataset.target).forEach(t => {
            t.classList.contains("open") ? o(t) : (t => {
                const e = t.scrollHeight + "px";
                setTimeout(() => {
                    t.style.height = e,
                    t.style.opacity = 1
                }, 200),
                animateNode(t, () => {
                    t.style.removeProperty("overflow"),
                    t.style.removeProperty("height"),
                    t.style.removeProperty("opacity"),
                    t.classList.add("open")
                })
            })(t)
        });
        const a = e.closest(".accordion");
        if (a) {
            a.querySelectorAll('[data-toggle="collapse"]').forEach(t => {
                t !== e && t.classList.remove("active")
            });
            a.querySelectorAll(".collapse").forEach(t => {
                t.classList.contains("open") && o(t)
            })
        }
    };
    on("body", "click", '[data-toggle="collapse"]', e => {
        t(e)
    })
};
collapse();
const darkMode = () => {
    const t = document.documentElement,
        e = localStorage.getItem("scheme"),
        o = document.getElementById("darkModeToggler");
    if (e && t.classList.add(e), "dark" === e) {
        if (! o)
            return;

        o.checked = "checked"
    }
    o.addEventListener("change", () => {
        (e => !(! t.classList.contains("dark") && e.checked))(o) ? (t.classList.remove("dark"), t.classList.add("light"), localStorage.removeItem("scheme")) : (t.classList.remove("light"), t.classList.add("dark"), localStorage.setItem("scheme", "dark"))
    })
};
darkMode();
const customFileInput = () => {
    on("body", "change", 'input[type="file"]', t => {
        const e = t.target.value.split("\\").pop();
        t.target.parentNode.querySelector(".file-name").innerHTML = e
    })
};
on("body", "change", 'input[type="file"]', t => {
    const e = t.target.value.split("\\").pop();
    t.target.parentNode.querySelector(".file-name").innerHTML = e
});
const fullscreen = () => {
    const t = document.getElementById("fullScreenToggler");
    if (! t)
        return;

    const e = document.documentElement;
    t.addEventListener("click", () => {
        document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement ? document.exitFullscreen ? document.exitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitExitFullscreen ? document.webkitExitFullscreen() : document.msExitFullscreen && document.msExitFullscreen() : e.requestFullscreen ? e.requestFullscreen() : e.mozRequestFullScreen ? e.mozRequestFullScreen() : e.webkitRequestFullscreen ? e.webkitRequestFullscreen() : e.msRequestFullscreen && e.msRequestFullscreen(),
        t.classList.contains("la-expand-arrows-alt") ? (t.classList.remove("la-expand-arrows-alt"), t.classList.add("la-compress-arrows-alt")) : (t.classList.remove("la-compress-arrows-alt"), t.classList.add("la-expand-arrows-alt"))
    })
};
fullscreen();
const menu = () => {
    const t = document.documentElement,
        e = localStorage.getItem("menuType"),
        o = document.querySelector(".menu-bar"),
        a = document.querySelector(".menu-items");
    if (! o)
        return;

    e && t.classList.add(e) || o.classList.add(e);
    const r = () => {
        o.querySelectorAll(".menu-detail.open").forEach(t => {
            hideOverlay(),
            o.classList.contains("menu-wide") || t.classList.remove("open")
        })
    };
    document.addEventListener("click", t => {
        t.target.closest(".menu-items a") || t.target.closest(".menu-detail") || o.classList.contains("menu-wide") || r()
    });
    on(".menu-items", "click", ".link", t => {
        const e = t.target.closest(".link").dataset.target,
            a = o.querySelector('.menu-detail[data-menu="' + e + '"]');
        o.classList.contains("menu-wide") && a ? a.classList.contains("open") ? (t => {
            t.style.overflow = "hidden";
            const e = t.scrollHeight + "px";
            t.style.height = e,
            setTimeout(() => {
                t.style.height = 0,
                t.style.opacity = 0
            }, 200),
            animateNode(t, () => {
                t.style.removeProperty("overflow"),
                t.style.removeProperty("height"),
                t.style.removeProperty("opacity"),
                t.classList.remove("open")
            })
        })(a) : a.classList.contains("collapse") && (t => {
            const e = t.scrollHeight + "px";
            setTimeout(() => {
                t.style.height = e,
                t.style.opacity = 1
            }, 200),
            animateNode(t, () => {
                t.style.removeProperty("overflow"),
                t.style.removeProperty("height"),
                t.style.removeProperty("opacity"),
                t.classList.add("open")
            })
        })(a) : (r(), a ? (showOverlay(!0), a.classList.add("open")) : hideOverlay())
    });
    on(".top-bar", "click", "[data-toggle='menu']", e => {
        o.classList.contains("menu-hidden") ? (t.classList.remove("menu-hidden"), o.classList.remove("menu-hidden")) : (t.classList.add("menu-hidden"), o.classList.add("menu-hidden"))
    });
    const i = () => {
            o.querySelector(".menu-header").classList.remove("hidden"),
            o.querySelectorAll(".menu-items .link").forEach(t => {
                const e = t.dataset.target,
                    a = o.querySelector('.menu-detail[data-menu="' + e + '"]');
                a && (a.classList.add("collapse"), t.after(a))
            })
        },
        s = () => {
            t.classList.remove("menu-wide"),
            o.classList.remove("menu-wide"),
            o.querySelector(".menu-header").classList.add("hidden"),
            o.querySelectorAll(".menu-items .link").forEach(t => {
                const e = t.dataset.target,
                    r = o.querySelector('.menu-detail[data-menu="' + e + '"]');
                r && (r.classList.remove("collapse"), a.after(r))
            })
        };
    o.classList.contains("menu-wide") && i(),
    on(".menu-bar", "click", "[data-toggle='menu-type']", e => {
        (e => {
            const a = o.querySelector(".menu-detail.open");
            switch (e) {
                case "icon-only": t.classList.add("menu-icon-only"),
                    o.classList.add("menu-icon-only"),
                    localStorage.setItem("menuType", "menu-icon-only"),
                    o.classList.contains("menu-wide") && (s(), a && showOverlay(!0));
                    break;
                case "wide": t.classList.add("menu-wide"),
                    o.classList.add("menu-wide"),
                    localStorage.setItem("menuType", "menu-wide"),
                    t.classList.remove("menu-icon-only"),
                    o.classList.remove("menu-icon-only"),
                    i(),
                    a && hideOverlay();
                    break;
                case "hidden": t.classList.add("menu-hidden"),
                    o.classList.add("menu-hidden"),
                    localStorage.setItem("menuType", "menu-hidden"),
                    r();
                    break;
                default: t.classList.remove("menu-icon-only"),
                    o.classList.remove("menu-icon-only"),
                    localStorage.removeItem("menuType"),
                    o.classList.contains("menu-wide") && (s(), a && showOverlay(!0))
            }
        })(e.target.closest("[data-toggle='menu-type']").dataset.value)
    })
};
menu();
const modal = () => {
    on("body", "click", '[data-toggle="modal"]', e => {
        (e => {

            // showOverlay(),
            e.classList.add("active");
            const o = e.dataset.animations.split(", ")[0],
                a = e.querySelector(".modal-content");
            animateCSS(a, o),
            e.addEventListener("click", o => {
                void 0 === e.dataset.staticBackdrop && e === o.target && t(e)
            })
        })(document.querySelector(e.target.dataset.target))
    });
    const t = t => {
        hideOverlay();
        const e = t.dataset.animations.split(", ")[1],
            o = t.querySelector(".modal-content");
        animateCSS(o, e, () => {
            t.classList.remove("active")
        })
    };
    on(".modal", "click", '[data-dismiss="modal"]', e => {
        console.log('here');
        hideOverlay();
        const o = e.target.closest(".modal");
        t(o)
    })
};
modal();
const showOverlay = t => {
        if (document.querySelector(".overlay"))
            return;

        document.body.classList.add("overlay-show");
        const e = document.createElement("div");
        t ? e.setAttribute("class", "overlay workspace") : e.setAttribute("class", "overlay"),
        document.body.appendChild(e),
        e.classList.add("active")
    },
    hideOverlay = () => {
        console.log('here');
        overlayToRemove = document.querySelector(".overlay"),
        overlayToRemove && (document.body.classList.remove("overlay-show"), overlayToRemove.classList.remove("active"), document.body.removeChild(overlayToRemove))
    },
    ratingStars = () => {
        rateStars = t => {
            const e = t.target.closest(".rating-stars"),
                o = Array.from(e.children);
            let a = 0;
            a = o.length - o.indexOf(t.target),
            o.forEach(t => t.classList.remove("active")),
            t.target.classList.add("active"),
            console.log("You have rated " + a + " stars.")
        },
        on("body", "click", ".rating-stars", t => {
            rateStars(t)
        })
    };
rateStars = t => {
    const e = t.target.closest(".rating-stars"),
        o = Array.from(e.children);
    let a = 0;
    a = o.length - o.indexOf(t.target),
    o.forEach(t => t.classList.remove("active")),
    t.target.classList.add("active"),
    console.log("You have rated " + a + " stars.")
},
on("body", "click", ".rating-stars", t => {
    rateStars(t)
});
const showPassword = () => {
    on("body", "click", '[data-toggle="password-visibility"]', t => {
        (t => {
            const e = t.closest(".form-control-addon-within").querySelector("input");
            "password" === e.type ? (e.type = "text", t.classList.remove("text-gray-600", "dark:text-gray-600"), t.classList.add("text-primary", "dark:text-primary")) : (e.type = "password", t.classList.remove("text-primary", "dark:text-primary"), t.classList.add("text-gray-600", "dark:text-gray-600"))
        })(t.target.closest('[data-toggle="password-visibility"]'))
    })
};
on("body", "click", '[data-toggle="password-visibility"]', t => {
    (t => {
        const e = t.closest(".form-control-addon-within").querySelector("input");
        "password" === e.type ? (e.type = "text", t.classList.remove("text-gray-600", "dark:text-gray-600"), t.classList.add("text-primary", "dark:text-primary")) : (e.type = "password", t.classList.remove("text-primary", "dark:text-primary"), t.classList.add("text-gray-600", "dark:text-gray-600"))
    })(t.target.closest('[data-toggle="password-visibility"]'))
});
const sidebar = () => {
    on("body", "click", '[data-toggle="sidebar"]', () => {
        (() => {
            const t = document.querySelector(".sidebar");
            t.classList.contains("open") ? (t.classList.remove("open"), hideOverlay()) : (t.classList.add("open"), showOverlay(!0))
        })()
    })
};
sidebar();
const tabs = () => {
    on("body", "click", '[data-toggle="tab"]', t => {
        const e = t.target.closest('[data-toggle="tab"]'),
            o = e.closest(".tabs"),
            a = o.querySelector(e.dataset.target),
            r = o.querySelector(".tab-nav .active"),
            i = o.querySelector(".collapse.open");
        if (r === e)
            return;

        r.classList.remove("active"),
        e.classList.add("active"),
        i.style.overflow = "hidden";
        let s = i.scrollHeight + "px";
        i.style.height = s,
        setTimeout(() => {
            i.style.height = 0,
            i.style.opacity = 0
        }, 200),
        animateNode(i, () => {
            i.classList.remove("open"),
            s = a.scrollHeight + "px",
            setTimeout(() => {
                a.style.height = s,
                a.style.opacity = 1
            }, 200),
            animateNode(a, () => {
                a.style.overflow = "visible",
                a.style.height = null,
                a.classList.add("open")
            })
        })
    })
};
on("body", "click", '[data-toggle="tab"]', t => {
    const e = t.target.closest('[data-toggle="tab"]'),
        o = e.closest(".tabs"),
        a = o.querySelector(e.dataset.target),
        r = o.querySelector(".tab-nav .active"),
        i = o.querySelector(".collapse.open");
    if (r === e)
        return;

    r.classList.remove("active"),
    e.classList.add("active"),
    i.style.overflow = "hidden";
    let s = i.scrollHeight + "px";
    i.style.height = s,
    setTimeout(() => {
        i.style.height = 0,
        i.style.opacity = 0
    }, 200),
    animateNode(i, () => {
        i.classList.remove("open"),
        s = a.scrollHeight + "px",
        setTimeout(() => {
            a.style.height = s,
            a.style.opacity = 1
        }, 200),
        animateNode(a, () => {
            a.style.overflow = "visible",
            a.style.height = null,
            a.classList.add("open")
        })
    })
});
const customTippy = () => {
    tippy.delegate("body", {
        target: '.icon-only [data-toggle="tooltip-menu"]',
        touch: [
            "hold", 500
        ],
        theme: "light-border tooltip",
        offset: [
            0, 12
        ],
        interactive: !0,
        animation: "scale",
        placement: "right",
        appendTo: () => document.body
    }),
    tippy('[data-toggle="tooltip"]', {
        theme: "light-border tooltip",
        touch: [
            "hold", 500
        ],
        offset: [
            0, 12
        ],
        interactive: !0,
        animation: "scale"
    }),
    tippy('[data-toggle="popover"]', {
        theme: "light-border popover",
        offset: [
            0, 12
        ],
        interactive: !0,
        allowHTML: !0,
        trigger: "click",
        animation: "shift-toward-extreme",
        content: t => "<h5>" + t.dataset.popoverTitle + '</h5><div class="mt-5">' + t.dataset.popoverContent + "</div>"
    }),
    tippy('[data-toggle="dropdown-menu"]', {
        theme: "light-border",
        zIndex: 45,
        offset: [
            0, 8
        ],
        arrow: !1,
        placement: "bottom-start",
        interactive: !0,
        allowHTML: !0,
        animation: "shift-toward-extreme",
        content: t => {
            let e = t.closest(".dropdown").querySelector(".dropdown-menu");
            return e = e.outerHTML,
            e
        }
    }),
    tippy('[data-toggle="custom-dropdown-menu"]', {
        theme: "light-border",
        zIndex: 45,
        offset: [
            0, 8
        ],
        arrow: !1,
        placement: "bottom-start",
        interactive: !0,
        allowHTML: !0,
        animation: "shift-toward-extreme",
        content: t => {
            let e = t.closest(".dropdown").querySelector(".custom-dropdown-menu");
            return e = e.outerHTML,
            e
        }
    }),
    tippy('[data-toggle="search-select"]', {
        theme: "light-border",
        offset: [
            0, 8
        ],
        maxWidth: "none",
        arrow: !1,
        placement: "bottom-start",
        trigger: "click",
        interactive: !0,
        allowHTML: !0,
        animation: "shift-toward-extreme",
        content: t => {
            let e = t.closest(".search-select").querySelector(".search-select-menu");
            return e = e.outerHTML,
            e
        },
        appendTo: t => t.closest(".search-select")
    })
};
tippy.delegate("body", {
    target: '.icon-only [data-toggle="tooltip-menu"]',
    touch: [
        "hold", 500
    ],
    theme: "light-border tooltip",
    offset: [
        0, 12
    ],
    interactive: !0,
    animation: "scale",
    placement: "right",
    appendTo: () => document.body
}),
tippy('[data-toggle="tooltip"]', {
    theme: "light-border tooltip",
    touch: [
        "hold", 500
    ],
    offset: [
        0, 12
    ],
    interactive: !0,
    animation: "scale"
}),
tippy('[data-toggle="popover"]', {
    theme: "light-border popover",
    offset: [
        0, 12
    ],
    interactive: !0,
    allowHTML: !0,
    trigger: "click",
    animation: "shift-toward-extreme",
    content: t => "<h5>" + t.dataset.popoverTitle + '</h5><div class="mt-5">' + t.dataset.popoverContent + "</div>"
}),
tippy('[data-toggle="dropdown-menu"]', {
    theme: "light-border",
    zIndex: 45,
    offset: [
        0, 8
    ],
    arrow: !1,
    placement: "bottom-start",
    interactive: !0,
    allowHTML: !0,
    animation: "shift-toward-extreme",
    content: t => {
        let e = t.closest(".dropdown").querySelector(".dropdown-menu");
        return e = e.outerHTML,
        e
    }
}),
tippy('[data-toggle="custom-dropdown-menu"]', {
    theme: "light-border",
    zIndex: 45,
    offset: [
        0, 8
    ],
    arrow: !1,
    placement: "bottom-start",
    interactive: !0,
    allowHTML: !0,
    animation: "shift-toward-extreme",
    content: t => {
        let e = t.closest(".dropdown").querySelector(".custom-dropdown-menu");
        return e = e.outerHTML,
        e
    }
}),
tippy('[data-toggle="search-select"]', {
    theme: "light-border",
    offset: [
        0, 8
    ],
    maxWidth: "none",
    arrow: !1,
    placement: "bottom-start",
    trigger: "click",
    interactive: !0,
    allowHTML: !0,
    animation: "shift-toward-extreme",
    content: t => {
        let e = t.closest(".search-select").querySelector(".search-select-menu");
        return e = e.outerHTML,
        e
    },
    appendTo: t => t.closest(".search-select")
});
const toasts = () => {
    const t = document.getElementById("toasts-container");
    on("body", "click", '[data-toggle="toast"]', o => {
        (o => {
            const a = o.dataset.title,
                r = o.dataset.content;
            let i = '<div class="toast"><div class="toast-wrapper mb-5"><div class="toast-header"><h5>' + a + "</h5><small>" + o.dataset.time + '</small><button type="button" class="close" data-dismiss="toast">&times</button></div><div class="toast-body">' + r + "</div></div></div>";
            i = (new DOMParser).parseFromString(i, "text/html").body.firstChild,
            i.querySelector('[data-dismiss="toast"]').addEventListener("click", () => {
                e(i)
            }),
            t.appendChild(i),
            animateCSS(i, "fadeInUp")
        })(o.target)
    });
    const e = t => {
        animateCSS(t, "fadeOutUp", () => {
            t.style.opacity = 0,
            t.style.overflow = "hidden",
            t.style.height = t.scrollHeight + "px",
            setTimeout(() => {
                t.style.height = 0
            }),
            animateNode(t, () => {
                t.parentNode && t.parentNode.removeChild(t)
            })
        })
    };
    on("body", "click", '[data-dismiss="toast"]', t => {
        toast = t.target.closest(".toast"),
        e(toast)
    })
};
toasts();
