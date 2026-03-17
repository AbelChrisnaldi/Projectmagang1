<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Telkom University — Dashboard</title>

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

        .logo {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: #d81e3a;
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

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #4b8df8;
            color: white;
        }

        /* POPUP FORM */
        #popupContainer {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .popup-box {
            background: white;
            padding: 20px;
            border-radius: 16px;
            width: 420px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.25);
        }

        .input-field {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
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
    </style>
</head>

<body>

    <header>
        <div class="brand">
            <div class="logo">Tel-U</div>
            <div>
                <h2>Telkom University</h2>
                <p style="font-size: 14px; color: #666;">Dashboard Akademik</p>
            </div>
        </div>

        <div>
            <button class="btn small" id="scrollToDashboard">Lihat Dashboard</button>
            <button class="btn small" id="refreshDashboard">Refresh</button>
            <button class="btn small" id="fullscreenDash">Fullscreen</button>
            <button class="btn" id="darkModeBtn">Mode Gelap</button>
        </div>
    </header>

    <!-- TABS -->
    <div class="tab-container">
        <button class="tab-btn active" data-tab="dashboardTab">Dashboard</button>
        <button class="tab-btn" data-tab="dataTab">Data</button>
    </div>

    <!-- TAB DASHBOARD -->
    <div id="dashboardTab" class="tab-content" style="display:block;">
        <h2 style="color:#d81e3a;">Dashboard Dosen</h2>

        <div class="dashboard-box">
            <iframe title="Dashboard Dosen Revisi" width="600" height="373.5"
                src="https://app.powerbi.com/view?r=eyJrIjoiN2M4MWJiNmMtNzRiYy00NGRmLWE1N2EtYjZlYTliNmYwNTdjIiwidCI6IjkwYWZmZTBmLWMyYTMtNDEwOC1iYjk4LTZjZWI0ZTk0ZWYxNSIsImMiOjEwfQ%3D%3D&pageName=14660ed8e21f3f699c64"
                frameborder="0" allowFullScreen="true"></iframe>
        </div>
    </div>

    <!-- TAB DATA -->
    <div id="dataTab" class="tab-content" style="display:none;">
        <h2 style="color:#d81e3a;">Data Kegiatan Akademik</h2>

        <table class="w-full border-collapse table-fixed">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="px-4 py-3 text-left w-[12%]">Tanggal</th>
                    <th class="px-4 py-3 text-left w-[18%]">Kegiatan</th>
                    <th class="px-4 py-3 text-left w-[40%]">Outline</th>
                    <th class="px-4 py-3 text-center w-[15%]">Slide</th>
                    <th class="px-4 py-3 text-center w-[15%]">Notulensi</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @foreach ($kegiatans as $k)
                    <tr class="border-b align-top">
                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($k->tanggal)->format('Y-m-d') }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $k->kegiatan }}
                        </td>

                        <td class="px-4 py-3 break-words">
                            {{ $k->outline }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if ($k->link_slide)
                                <a href="{{ $k->link_slide }}" target="_blank" class="text-blue-600 hover:underline">
                                    Link
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if ($k->link_notulensi)
                                <a href="{{ $k->link_notulensi }}" target="_blank"
                                    class="text-blue-600 hover:underline">
                                    Link
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- POPUP -->
    <div id="popupContainer">
        <div class="popup-box">
            <h3 id="popupTitle">Tambah Kegiatan</h3>

            <input type="hidden" id="editId">

            <label>Tanggal:</label>
            <input type="date" id="tanggal" class="input-field">

            <label>Kegiatan:</label>
            <input type="text" id="kegiatan" class="input-field">

            <label>Outline:</label>
            <textarea id="outline" class="input-field" rows="4"></textarea>

            <label>Link Slide:</label>
            <input type="url" id="link_slide" class="input-field">

            <label>Link Notulensi:</label>
            <input type="url" id="link_notulensi" class="input-field">

            <button class="btn small" onclick="saveData()">Simpan</button>
            <button class="btn small" style="background:#777;" onclick="closePopup()">Batal</button>
        </div>
    </div>

    <footer>
        &copy; 2025 — <span>Telkom University</span> • Semua Program Studi
    </footer>

    <script>
        /* ===========================================
                           🌙 DARK MODE
                        =========================================== */
        document.getElementById("darkModeBtn").onclick = () => {
            document.body.classList.toggle("dark");
            darkModeBtn.textContent =
                document.body.classList.contains("dark") ?
                "Mode Terang" :
                "Mode Gelap";
        };

        /* ===========================================
           DASHBOARD BUTTONS
        =========================================== */
        const iframe = document.getElementById("dashboardFrame");

        scrollToDashboard.onclick = () => {
            document.getElementById("dashboardTab").scrollIntoView({
                behavior: "smooth"
            });
        };
        refreshDashboard.onclick = () => {
            iframe.src = iframe.src;
        };
        fullscreenDash.onclick = () => {
            iframe.requestFullscreen();
        };

        /* ===========================================
           TAB LOGIC
        =========================================== */
        document.querySelectorAll(".tab-btn").forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");

                document.querySelectorAll(".tab-content").forEach(c => c.style.display = "none");
                document.getElementById(btn.dataset.tab).style.display = "block";
            };
        });

        /* ===========================================
           CRUD — LOAD DATA (MySQL)
        =========================================== */
        function loadData() {
            fetch("/api/kegiatan")
                .then(res => res.json())
                .then(data => {
                    let html = "";
                    data.forEach(k => {
                        html += `
                <tr>
                    <td>${k.tanggal ?? "-"}</td>
                    <td>${k.kegiatan}</td>
                    <td><pre style="white-space:pre-line">${k.outline ?? ""}</pre></td>
                    <td><a href="${k.link_slide}" target="_blank">link</a></td>
                    <td><a href="${k.link_notulensi}" target="_blank">link</a></td>
                    <td>
                        <button class="btn small" onclick="editData(${k.id})">Edit</button>
                        <button class="btn small" style="background:#d9534f" onclick="deleteData(${k.id})">Hapus</button>
                    </td>
                </tr>`;
                    });
                    document.getElementById("dataBody").innerHTML = html;
                });
        }
        loadData();

        /* ===========================================
           SHOW + CLOSE POPUP
        =========================================== */
        function showAddForm() {
            document.getElementById("popupTitle").innerText = "Tambah Kegiatan";
            document.getElementById("editId").value = "";
            document.getElementById("tanggal").value = "";
            document.getElementById("kegiatan").value = "";
            document.getElementById("outline").value = "";
            document.getElementById("link_slide").value = "";
            document.getElementById("link_notulensi").value = "";
            document.getElementById("popupContainer").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("popupContainer").style.display = "none";
        }

        /* ===========================================
           SAVE / UPDATE
        =========================================== */
        function saveData() {
            const id = document.getElementById("editId").value;

            const payload = {
                tanggal: tanggal.value,
                kegiatan: kegiatan.value,
                outline: outline.value,
                link_slide: link_slide.value,
                link_notulensi: link_notulensi.value
            };

            fetch(id ? `/api/kegiatan/${id}` : "/api/kegiatan", {
                method: id ? "PUT" : "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(payload)
            }).then(() => {
                closePopup();
                loadData();
            });
        }

        /* ===========================================
           EDIT
        =========================================== */
        function editData(id) {
            fetch("/api/kegiatan")
                .then(res => res.json())
                .then(list => {
                    const k = list.find(x => x.id === id);

                    popupTitle.innerText = "Edit Kegiatan";
                    editId.value = k.id;
                    tanggal.value = k.tanggal;
                    kegiatan.value = k.kegiatan;
                    outline.value = k.outline;
                    link_slide.value = k.link_slide;
                    link_notulensi.value = k.link_notulensi;

                    popupContainer.style.display = "flex";
                });
        }

        /* ===========================================
           DELETE
        =========================================== */
        function deleteData(id) {
            if (!confirm("Hapus kegiatan ini?")) return;

            fetch(`/api/kegiatan/${id}`, {
                    method: "DELETE"
                })
                .then(() => loadData());
        }
    </script>

</body>

</html>
