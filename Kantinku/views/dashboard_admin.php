<!doctype html>
<html lang="en">
  <?php include 'header.php'; ?>
  <body>
  <div class="container" style="margin-top : 50px;">
        <div class="row d-flex justify-content-center align-items-center" style="height: 100%;">
            <div class="col-12 justify-content-center align-items-center mb-3 mb-md-0">
                <?php include 'navbaradmin.php'; ?>
                <div class="card" style="width: 100%; border: none; box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1); border-top-left-radius: 0px; border-top-right-radius: 20px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; margin-bottom : 20px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Top 10 Produk Terlaris</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div id="trafficChart" style="width: 100%; height: 450px; margin-top:30px"></div>
                            <div id="legendContainer" style="margin-left: 20px;"></div>
                        </div>
                        <h5 class="card-title text-center">Omset Harian</h5>
                        <table class="table mt-4" style="width: max-content; margin: 5% 37%;">
                            <tbody id="activity-list">
                            </tbody>
                        </table>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.3/echarts.min.js"></script>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                function fetchData() {
                                    $.ajax({
                                        url: '/kantinku/top_produk',
                                        type: 'GET',
                                        success: function(data) {
                                            var chartData = data.map(item => {
                                                return { value: item.jumlah, name: item.nama_produk };
                                            });
                                            renderChart(chartData);
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Terjadi kesalahan: " + error);
                                        }
                                    });
                                }

                                function renderChart(data) {
                                    const chartDom = document.querySelector("#trafficChart");
                                    const myChart = echarts.init(chartDom);

                                    const option = {
                                        tooltip: {
                                            trigger: 'item',
                                            formatter: '{a} <br/>{b} : {c} ({d}%)'
                                        },
                                        series: [{
                                            name: 'Produk',
                                            type: 'pie',
                                            radius: '70%',
                                            center: ['50%', '50%'],
                                            data: data,
                                            emphasis: {
                                                itemStyle: {
                                                    shadowBlur: 10,
                                                    shadowOffsetX: 0,
                                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                }
                                            }
                                        }],
                                        legend: {
                                            orient: 'vertical',
                                            left: '75%',
                                            data: data.map(item => item.name),
                                            container: '#legendContainer'
                                        }
                                    };

                                    myChart.setOption(option);

                                    window.addEventListener('resize', () => {
                                        myChart.resize();
                                    });
                                }

                                fetchData();

                                function fetchActivityData() {
                                    $.ajax({
                                        url: '/kantinku/omset_penjualan',
                                        type: 'GET',
                                        success: function(data2) {
                                            var activityList = $('#activity-list');
                                            activityList.empty();

                                            var badgeColors = ['text-success', 'text-danger', 'text-warning', 'text-info', 'text-primary'];

                                            data2.forEach(function(item, index) {
                                                var badgeColor = badgeColors[index % badgeColors.length];
                                                var daysAgo = Math.floor((new Date() - new Date(item.tanggal_penjualan)) / (1000 * 60 * 60 * 24));
                                                var daysText = daysAgo === 0 ? 'Hari ini' : `${daysAgo} Hari lalu`;

                                                var activityItem = `
                                                    <tr>
                                                        <td><span class="badge ${badgeColor}">${daysText}</span></td>
                                                        <td>${new Date(item.tanggal_penjualan).toLocaleDateString('id-ID')}</td>
                                                        <td>Rp. ${item.total_penjualan.toLocaleString('id-ID')}</td>
                                                    </tr>
                                                `;
                                                activityList.append(activityItem);
                                            });
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Terjadi kesalahan: " + error);
                                        }
                                    });
                                }

                                fetchActivityData();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>
