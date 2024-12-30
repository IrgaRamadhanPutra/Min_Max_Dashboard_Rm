<script>
    function refreshPage() {
        // Menggunakan location.reload() untuk me-refresh halaman
        location.reload();
    }
    setTimeout(function() {
        location.reload();
    }, 180000); // 300000 milidetik = 5 menit


    function formatDate(date) {
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];

        const day = days[date.getDay()];
        const dayOfMonth = date.getDate().toString().padStart(2, '0'); // Pad with leading zero if needed
        const month = months[date.getMonth()];
        const year = date.getFullYear();

        return `${day}, ${dayOfMonth} ${month} ${year}`;
    }

    function updateCurrentDateAndDay() {
        const currentDateElement = $('#currentDate');
        const currentDate = new Date();
        const formattedDate = formatDate(currentDate);

        currentDateElement.text(formattedDate);
    }

    // PIE CHART
    Chart.register(ChartDataLabels);

    document.addEventListener('DOMContentLoaded', function() {
        // Ambil data dari server (Laravel blade syntax)
        var carouselPageData = @json($carouselPages[0]);

        carouselPageData.forEach(function(page) {
            // ID canvas untuk chart
            var ctx = document.getElementById('pieChart-' + page.type).getContext('2d');

            // Data untuk chart
            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [
                            page.kritis_percentage,
                            page.over_percentage,
                            page.ok_percentage
                        ],
                        backgroundColor: [
                            'rgba(255, 0, 32, 0.8)', // KRITIS
                            'rgb(255, 205, 86)', // OVER
                            'rgba(121, 214, 126, 1)' // OK
                        ],
                        borderColor: [
                            'rgba(255, 0, 32, 1)',
                            'rgb(255, 205, 86)',
                            'rgba(121, 214, 126, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false // Tidak menggunakan legend bawaan Chart.js
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    let dataIndex = tooltipItem.dataIndex;
                                    let value = tooltipItem.raw;
                                    let count = [
                                        page.kritis,
                                        page.over,
                                        page.ok
                                    ][dataIndex];
                                    // Hanya menampilkan jumlah dan persentase
                                    return `${value.toFixed(2)}% (${count} ITEM)`;
                                }
                            }
                        },
                        datalabels: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.8)',
                            formatter: function(value, context) {
                                let dataIndex = context.dataIndex;
                                let count = [
                                    page.kritis,
                                    page.over,
                                    page.ok
                                ][dataIndex];
                                // Hanya menampilkan persentase dan jumlah
                                return `${value.toFixed(2)}%\n(${count} ITEM)`;
                            },
                            anchor: 'center',
                            align: 'center',
                            font: {
                                weight: 'bold',
                                size: 12
                            }
                        }
                    }
                }
            });


            // Manual Legend di Bawah Chart
            var legendContainer = document.createElement('div');
            legendContainer.style.display = 'flex';
            legendContainer.style.justifyContent = 'center';
            legendContainer.style.marginTop = '10px';

            var colors = [{
                    color: 'rgba(255, 0, 32, 0.8)',
                    label: 'KRITIS'
                },
                {
                    color: 'rgb(255, 205, 86)',
                    label: 'OVER'
                },
                {
                    color: 'rgba(121, 214, 126, 1)',
                    label: 'OK'
                }
            ];

            colors.forEach(function(item) {
                var legendItem = document.createElement('div');
                legendItem.style.display = 'flex';
                legendItem.style.alignItems = 'center';
                legendItem.style.marginRight = '15px';

                var colorBox = document.createElement('span');
                colorBox.style.width = '15px';
                colorBox.style.height = '15px';
                colorBox.style.backgroundColor = item.color;
                colorBox.style.marginRight = '5px';
                // colorBox.style.border = '1px solid black';

                var label = document.createElement('span');
                label.textContent = item.label;
                label.style.fontSize = '12px';

                legendItem.appendChild(colorBox);
                legendItem.appendChild(label);
                legendContainer.appendChild(legendItem);
            });

            // Masukkan legend di bawah chart
            ctx.canvas.parentNode.appendChild(legendContainer);
        });
    });

    //  bar chart
    document.addEventListener("DOMContentLoaded", () => {
        new Chart(document.querySelector('#barChart'), {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Bar Chart',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
    // scroll ing fot table
    document.addEventListener('DOMContentLoaded', function() {
        const scrollableTbodies = document.querySelectorAll(
            '[id^="scrollable-tbody-"]'); // Select all elements with IDs starting with 'scrollable-tbody-'

        let scrollSpeed = 60; // Adjust the scroll speed (in milliseconds)
        let scrollStep = 1; // Adjust the number of pixels scrolled per step

        // Function to start the scrolling
        function startScrolling() {
            scrollableTbodies.forEach(function(scrollableTbody) {
                // Stop the previous interval if it exists
                if (scrollableTbody.dataset.interval) {
                    clearInterval(scrollableTbody.dataset.interval);
                }

                // Set interval to perform scroll
                let intervalId = setInterval(() => {
                    // Increment the scroll position
                    scrollableTbody.scrollTop += scrollStep;

                    // Check if we have reached the bottom of the tbody
                    if (scrollableTbody.scrollTop + scrollableTbody.clientHeight >=
                        scrollableTbody.scrollHeight) {
                        scrollableTbody.scrollTop = 0; // Reset scroll to the top
                    }
                }, scrollSpeed);

                // Save the interval ID in dataset for later removal
                scrollableTbody.dataset.interval = intervalId;
            });
        }

        // Start scrolling when the DOM is ready
        startScrolling();

        // Handle window resize event
        window.addEventListener('resize', function() {
            // Check if the window width is below 900px
            if (window.innerWidth < 900) {
                // Stop scrolling if the resolution is less than 900px
                scrollableTbodies.forEach(function(scrollableTbody) {
                    if (scrollableTbody.dataset.interval) {
                        clearInterval(scrollableTbody.dataset.interval); // Clear the interval
                        delete scrollableTbody.dataset
                            .interval; // Remove the interval from dataset
                    }
                });
            } else {
                // Restart scrolling if the window width is 900px or more
                startScrolling();
            }
        });
    });

    // update footer
    function updateFooter(carouselPages) {
        let footerContent = $('#footerContent');
        let scrollingText = carouselPages[0].map(group => {
            // Format string sesuai dengan data type dan persentase
            return `${group.type}: OK ${group.ok_percentage.toFixed(2)}%, OVER ${group.over_percentage.toFixed(2)}%, KRITIS ${group.kritis_percentage.toFixed(2)}%`;
        }).join(' | ');

        // Tambahkan teks statis di akhir
        scrollingText +=
            ' | PT TRIMITRA CHITRAHASTA | Always Think Ahead | MARI BERSAMA MENJAGA AKURASI STOCK AKTUAL DENGAN STOCK DI SISTEM | Terapkan 5R di gudang: Ringkas barang yang tidak perlu, Rapi dalam penyimpanan, Resik jaga kebersihan, Rawat fasilitas dengan baik, dan Rajin disiplin menjalankannya setiap hari. Bersama kita wujudkan gudang yang efisien, aman, dan nyaman! | DEVELOPMENT BY IT DEPT PT. TRIMITRA CITRAHASTA';

        footerContent.text(scrollingText);

        // Animasi scroll
        const container = document.getElementById('footerContent');
        const scrollAmount = container.scrollWidth;
        const scrollDuration = 180000; // Durasi scroll dalam milidetik
        let startTime;

        function animateScroll(timestamp) {
            if (!startTime) startTime = timestamp;
            const elapsed = timestamp - startTime;
            const progress = (elapsed / scrollDuration) % 1;
            container.style.transform = `translateX(${Math.max(-scrollAmount, -scrollAmount * progress)}px)`;
            requestAnimationFrame(animateScroll);
        }

        requestAnimationFrame(animateScroll);
    }

    // fungsi updateFooter
    $(document).ready(function() {
        // Gantikan ini dengan data dari server
        const carouselPages = @json($carouselPages);

        updateFooter(carouselPages);
    });

    // JavaScript function to alert the value when clicked
    function getValue(value) {
        // Menampilkan alert
        // alert('Value: ' + value);

        // Sembunyikan elemen dengan id cardCarousel
        const cardCarousel = document.getElementById('cardCarousel');
        if (cardCarousel) {
            cardCarousel.style.display = 'none';
        }

        // Tampilkan elemen dengan id cardCarousel2
        const cardCarousel2 = document.getElementById('cardCarousel2');
        if (cardCarousel2) {
            cardCarousel2.style.display = 'block';
        }
        var process = value;
        // alert(process);
        // AJAX request untuk mengirimkan data ke server
        $.ajax({
            url: "{{ route('get_data_cust') }}",
            type: 'GET',
            data: {
                process: process, // Mengirimkan data process
                _token: '{{ csrf_token() }}' // Menyertakan token CSRF
            },
            success: function(response) {
                console.log(response);

                // Bersihkan elemen cardCarousel2
                $('#cardCarousel2').html('');

                // Ambil nilai groupGridpage1 dari response untuk menghitung kelas kolom
                let groupGridpage1 = response.groupGridpage1 || 2; // Default ke 2 jika tidak ada
                let columnClass = `col-md-${12 / groupGridpage1}`; // Hitung nilai col-md-* dinamis

                // Loop data carouselPages1 dan buat HTML dinamis
                let carouselContent = '<div class="carousel-inner">';
                response.carouselPages1.forEach((carouselPage, index) => {
                    const activeClass = index === 0 ? 'active' : '';
                    carouselContent +=
                        `<div class="carousel-item ${activeClass}"><div class="row">`;

                    // Iterasi setiap tabel dalam halaman carousel
                    carouselPage.forEach((table) => {
                        carouselContent += `
                        <div class="${columnClass} d-flex justify-content-center">
                            <div class="card"
                                style="width: 100%; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); background-color: #f8f9fa;">
                                <!-- Chart Section -->
                                <div class="chart-container p-1"
                                    style="display: flex; align-items: center; justify-content: space-between; background-color: #e9ebf0; height: 200px; border-radius: 8px;">
                                    <!-- Pie Chart -->
                                    <div style="flex: 2; display: flex; justify-content: center; align-items: center; padding: 5px;">
                                        <canvas id="pieChart1-${table.cust}" style="max-width: 180px; max-height: 180px;"></canvas>
                                    </div>

                                    <!-- Logo and Button Section -->
                                    <div style="flex: 1; text-align: center; padding: 10px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                    <!-- Logo Section -->
                                    <img src="assets/img/${table.cust.toLowerCase()}.png" alt="${table.cust} Logo"
                                        style="width: 180px; height: 100px; margin-bottom: 10px;">

                                    <!-- Button Section -->
                                    <button onclick="showCardCarousel()"
                                        style="background-color: #007bff; color: white; border: none; border-radius: 5px; padding: 8px 15px; cursor: pointer; font-size: 0.9rem; margin-top: 10px;">
                                       <i class="ri-anticlockwise-2-line"></i> back
                                    </button>
                                </div>

                                </div>

                                <!-- Table Section -->
                                <div class="table-responsive p-3">
                                    <!-- Table for Header -->
                                    <table class="table custom-table2 mb-1">
                                        <thead>
                                            <tr>
                                                <td width="25%" class="text-center" rowspan="2"
                                                    style="padding:3pt; vertical-align: middle; font-weight: bold;">
                                                    ITEMCODE
                                                </td>
                                                <td width="30%" class="text-center" rowspan="2"
                                                    style="padding:3pt; vertical-align: middle; font-weight: bold;">
                                                    PART NO - PART NAME
                                                </td>
                                                <td width="10%" class="text-center" style="font-weight: bold;">MIN</td>
                                                <td width="15%" class="text-center" rowspan="2"
                                                    style="vertical-align: middle; font-weight: bold;">
                                                    RM STOCK
                                                </td>
                                                <td width="15%" class="text-center" rowspan="2"
                                                    style="vertical-align: middle; font-weight: bold;">
                                                    ALL STOCK
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="font-weight: bold;">MAX</td>
                                            </tr>
                                        </thead>
                                    </table>

                                    <!-- Table for Body -->
                                    <div style="max-height: 600px; overflow-y: none; overflow-x: hidden;">
                                    <table class="table mt-1 custom-table3"
                                        id="scrollable-tbody1-${table.cust}"
                                        style="
                                            border-collapse: collapse;
                                            width: 100%;
                                            background-color: #0056b3;
                                            border: 1px solid black;
                                        ">
                                        <tbody>
                                            ${table.items.map(item => `
                                                                                            <tr style="border: 1px solid black;">
                                                                                                <td rowspan="2" width="25%" style="border: 1px solid black; text-align: center;">${item.itemcode}</td>
                                                                                                <td rowspan="2" width="30%" style="border: 1px solid black; vertical-align: middle;">${item.part_number} - ${item.part_name}</td>
                                                                                                <td class="text-center" width="10%" style="border: 1px solid black;">${item.min}</td>
                                                                                                <td rowspan="2" width="15%" class="text-center" style="border: 1px solid black; background-color: ${item.balance < item.min ? 'rgba(255, 0, 32, 0.8)' : item.balance > item.max ? 'rgb(255, 205, 86)' : 'rgba(121, 214, 126, 1)'}; vertical-align: middle;">
                                                                                                    ${item.balance < item.min ? '<i class="ri-arrow-down-line"></i>' :
                                                                                                    item.balance > item.max ? '<i class="ri-arrow-up-line"></i>' :
                                                                                                    '<i class="ri-arrow-up-down-line"></i>'}
                                                                                                    ${item.balance}
                                                                                                </td>
                                                                                                <td rowspan="2" class="text-center" style="border: 1px solid black; background-color: ${item.quantity_plant < item.min ? 'rgba(255, 0, 32, 0.8)' : item.quantity_plant > item.max ? 'rgb(255, 205, 86)' : 'rgba(121, 214, 126, 1)'}; vertical-align: middle;">${item.quantity_plant}</td>
                                                                                            </tr>
                                                                                            <tr style="border: 1px solid black;">
                                                                                                <td class="text-center" style="border: 1px solid black;">${item.max}</td>
                                                                                            </tr>
                                                                                        `).join('')}
                                        </tbody>
                                    </table>
                                </div>

                                </div>
                            </div>
                        </div>`;
                    });


                    carouselContent += `</div></div>`;
                });

                carouselContent += '</div>';
                $('#cardCarousel2').html(carouselContent);

                // Generate Chart.js Pie Charts
                response.carouselPages1.forEach((carouselPage) => {
                    carouselPage.forEach((table) => {
                        let canvasElement = document.getElementById(
                            `pieChart1-${table.cust}`);
                        if (canvasElement) {
                            let ctx = canvasElement.getContext('2d');
                            new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['KRITIS', 'OVER', 'OK'],
                                    datasets: [{
                                        label: 'Status Percentages and Counts',
                                        data: [
                                            table.kritis_percentage,
                                            table.over_percentage,
                                            table.ok_percentage
                                        ],
                                        backgroundColor: [
                                            'rgba(255, 0, 32, 0.8)', // Kritis
                                            'rgb(255, 205, 86)', // Over
                                            'rgba(121, 214, 126, 1)', // OK
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgb(255, 205, 86)',
                                            'rgba(121, 214, 126, 1)',
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false // Sembunyikan legenda
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(tooltipItem) {
                                                    let dataIndex = tooltipItem
                                                        .dataIndex;
                                                    let value = tooltipItem.raw;
                                                    let label = tooltipItem
                                                        .label;
                                                    let count = [
                                                        table.kritis,
                                                        table.over,
                                                        table.ok
                                                    ][dataIndex];
                                                    return `${label}: ${value.toFixed(2)}% (${count} item)`;
                                                }
                                            }
                                        },
                                        datalabels: {
                                            display: true, // Tampilkan datalabel
                                            color: 'rgba(0, 0, 0, 0.8)',
                                            formatter: function(value, context) {
                                                let dataIndex = context
                                                    .dataIndex;
                                                let label = context.chart.data
                                                    .labels[dataIndex];
                                                let count = [
                                                    table.kritis,
                                                    table.over,
                                                    table.ok
                                                ][dataIndex];
                                                return `${label}\n${value.toFixed(2)}%\n(${count} ITEM)`;
                                            },
                                            anchor: 'center',
                                            align: 'center',
                                            font: {
                                                weight: 'bold',
                                                size: 12
                                            }
                                        }
                                    }
                                }
                            });
                        } else {
                            console.warn(`Canvas element for ${table.cust} not found`);
                        }
                    });
                });
                // Tambahkan logika scrolling di sini setelah carousel selesai dirender

            },

            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });


    }

    function showCardCarousel() {
        // Debugging
        console.log('Fungsi dipanggil');

        // Ambil elemen cardCarousel2
        const cardCarousel2 = document.getElementById('cardCarousel');
        if (cardCarousel2) {
            console.log('Menampilkan cardCarousel2');
            cardCarousel2.style.display = 'block'; // Tampilkan cardCarousel2
        }

        // Ambil elemen cardCarousel
        const cardCarousel = document.getElementById('cardCarousel2');
        if (cardCarousel) {
            console.log('Menyembunyikan cardCarousel');
            cardCarousel.style.display = 'none'; // Sembunyikan cardCarousel
        }
    }


    // // scroll ing fot table
    // document.addEventListener('DOMContentLoaded', function() {
    //     const scrollableTbodies = document.querySelectorAll('[id="scrollable-tbody1-"]');

    //     if (scrollableTbodies.length === 0) {
    //         console.log('Tidak ada elemen dengan id="scrollable-tbody1-" ditemukan');
    //     } else {
    //         console.log(`${scrollableTbodies.length} tabel ditemukan dengan id="scrollable-tbody1-"`);
    //     }

    //     scrollableTbodies.forEach((tbody) => {
    //         const tbodyElement = tbody; // reference to tbody element
    //         console.log('Tabel ditemukan:', tbodyElement);

    //         // Set interval for auto-scrolling
    //         setInterval(function() {
    //             // Log scroll position to check the values
    //             console.log('Scroll position:', tbodyElement.scrollTop);
    //             console.log('Tinggi scrollable area:', tbodyElement.scrollHeight);
    //             console.log('Tinggi viewable area:', tbodyElement.clientHeight);

    //             // Scroll the table's tbody to the bottom, then reset to the top when it reaches the end
    //             if (tbodyElement.scrollTop + tbodyElement.clientHeight >= tbodyElement
    //                 .scrollHeight) {
    //                 console.log('Mencapai akhir scroll, reset ke atas');
    //                 tbodyElement.scrollTop = 0; // Reset scroll to the top
    //             } else {
    //                 console.log('Scroll menambah 1px');
    //                 tbodyElement.scrollTop +=
    //                     1; // Increment the scroll position down by 1 pixel
    //             }
    //         }, 20); // Adjust the scrolling speed by changing the interval (ms)
    //     });
    // });
</script>
