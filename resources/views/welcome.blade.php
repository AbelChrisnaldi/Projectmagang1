<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Telkom University — Dashboard</title>

    <link rel="icon" type="image/png" href="{{ asset('images/iconiebi.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(180deg, #f4f7ff, #e8ecf7);
            padding: 20px;
            color: #333;
            transition: 0.3s ease;
        }

        body.dark {
            background: #0a0f1a;
            color: #e6e6e6;
        }

        body.dark .dashboard-section,
        body.dark .tab-content,
        body.dark .popup-box {
            background: #141c2c;
            border-color: #2e3545;
            color: white;
        }

        body.dark .logo {
            background: #8b0000;
        }

        /* HEADER */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto 20px auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .logo {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
        }

        /* BUTTON STYLE */
        .btn {
            padding: 10px 18px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            background: #4b8df8;
            /* biru konsisten */
            color: white;
            font-size: 14px;
            font-weight: 500;
            margin-left: 6px;
            transition: 0.2s ease;
            height: 42px;
            /* kunci tinggi biar sama */
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn:hover {
            background: #2c72e3;
        }

        .btn.small {
            padding: 7px 12px;
            font-size: 12px;
        }

        /* TABS */
        .tab-container {
            max-width: 1200px;
            margin: 0 auto 15px auto;
        }

        .tab-btn {
            padding: 10px 18px;
            background: #d9d9d9;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-right: 6px;
            font-weight: 600;
            transition: 0.2s;
        }

        .tab-btn.active {
            background: #4b8df8;
            color: white;
            transform: translateY(-2px);
        }

        /* CONTENT */
        .tab-content {
            max-width: 1200px;
            margin: 0 auto 26px auto;
            background: white;
            padding: 26px;
            border-radius: 16px;
            border: 1px solid #e5e8f0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table-scroll {
            width: 100%;
            overflow-x: auto;
        }

        .table-scroll table {
            min-width: 760px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #4b8df8;
            color: white;
        }

        td:nth-child(4),
        td:nth-child(5),
        th:nth-child(4),
        th:nth-child(5) {
            text-align: center;
        }

        /* DASHBOARD BOX */
        .dashboard-box {
            width: 100%;
            height: 760px;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #d9deea;
            background: #fff;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        footer {
            background: white;
            padding: 20px;
            text-align: center;
            border-radius: 16px;
            max-width: 1200px;
            margin: 0 auto;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.08);
            color: #666;
        }

        footer span {
            font-weight: bold;
            color: #d81e3a;
        }

        @media (max-width: 768px) {
            body {
                padding: 12px;
            }

            header {
                flex-wrap: wrap;
                gap: 16px;
                align-items: flex-start;
            }

            .brand {
                align-items: flex-start;
            }

            .brand h1 {
                font-size: 18px;
                line-height: 1.25;
            }

            .tab-container {
                display: flex;
                gap: 8px;
            }

            .tab-btn {
                flex: 1;
                margin-right: 0;
            }

            .tab-content {
                padding: 16px;
            }

            .dashboard-box {
                height: 65vh;
                min-height: 420px;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="brand">
            <img src="{{ asset('images/iconiebi.png') }}" alt="Logo Telkom University">
            <div>
                <h1>Research Group of Industrial Engineering and Business Innovation (IEBI)</h1>
                <p style="font-size: 14px; color: #666;">Dashboard</p>
            </div>
        </div>

        <div style="display: none;">
            <button class="btn small" id="scrollToDashboard">Lihat Dashboard</button>
            <button class="btn small" id="refreshDashboard">Refresh</button>
            <button class="btn small" id="fullscreenDash">Fullscreen</button>
            <button class="btn" id="darkModeBtn">Mode Gelap</button>
        </div>

    </header>

    <!-- TABS -->
    <div class="tab-container" role="tablist" aria-label="Dashboard sections">
        <button type="button" class="tab-btn active" data-tab="dashboardTab" role="tab" aria-controls="dashboardTab" aria-selected="true">Dashboard</button>
        <button type="button" class="tab-btn" data-tab="dataTab" role="tab" aria-controls="dataTab" aria-selected="false">Archive</button>
        <button type="button" class="tab-btn" data-tab="documentTab" role="tab" aria-controls="documentTab" aria-selected="false">Document</button>
    </div>

    <!-- TAB DASHBOARD -->
    <main>
    <section id="dashboardTab" class="tab-content" style="display:block;">
        <h2 style="color:#d81e3a;">Dashboard</h2>

        <div class="dashboard-box">
            <iframe title="Dashboard Dosen Riib" width="600" height="373.5" src="https://app.powerbi.com/view?r=eyJrIjoiZjA0MmQ5OTUtNDUxNC00MTI1LWI2MTMtYzE2ZmY1ODdlYTM0IiwidCI6IjkwYWZmZTBmLWMyYTMtNDEwOC1iYjk4LTZjZWI0ZTk0ZWYxNSIsImMiOjEwfQ%3D%3D" allowfullscreen></iframe>
        </div>
    </section>

    <!-- TAB DATA -->
    <section id="dataTab" class="tab-content" style="display:none;">
        <h2 style="color:#d81e3a;">Data Kegiatan Akademik</h2>

        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kegiatan</th>
                    <th>Outline</th>
                    <th>Slide</th>
                    <th>Notulensi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kegiatans as $k)
                    <tr>
                        <td>
                            {{ $k->tanggal ? \Carbon\Carbon::parse($k->tanggal)->format('Y-m-d') : '-' }}
                        </td>

                        <td>
                            {{ $k->kegiatan }}
                        </td>

                        <td>
                            {{ $k->outline }}
                        </td>

                        <td>
                            @if ($k->link_slide)
                                <a href="{{ $k->link_slide }}" target="_blank" rel="noopener noreferrer">
                                    Link
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </td>

                        <td>
                            @if ($k->link_notulensi)
                                <a href="{{ $k->link_notulensi }}" target="_blank" rel="noopener noreferrer">
                                    Link
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; color:#666;">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </section>

    <!-- TAB DOKUMEN -->
    <section id="documentTab" class="tab-content" style="display:none;">
        <h2 style="color:#d81e3a;">Dokumen</h2>

        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dokumen</th>
                    <th>Link Dokumen</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($documents as $document)
                    <tr>
                        <td style="text-align:center;">
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <a href="{{ $document->link }}" target="_blank" rel="noopener noreferrer">
                                {{ $document->name }}
                            </a>
                        </td>

                        <td>
                            <a href="{{ $document->link }}" target="_blank" rel="noopener noreferrer" style="word-break: break-all;">
                                {{ $document->link }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center; color:#666;">Belum ada dokumen</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </section>
    </main>

    <footer>
        &copy; 2026 — <span>TUS KK</span> • Industrial Engineering and Business Innovation
    </footer>

    <script>
        document.querySelectorAll(".tab-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll(".tab-btn").forEach(b => {
                    b.classList.remove("active");
                    b.setAttribute("aria-selected", "false");
                });
                btn.classList.add("active");
                btn.setAttribute("aria-selected", "true");

                document.querySelectorAll(".tab-content").forEach(c => c.style.display = "none");

                const target = document.getElementById(btn.dataset.tab);
                if (target) {
                    target.style.display = "block";
                }
            });
        });
    </script>

</body>

</html>
