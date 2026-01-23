<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Anak</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pilih Anak</label>
                        <div class="col-sm-6">
                            <select id="anakSelect" class="form-control">
                                <option value="">-- Pilih Anak --</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <button id="generatePdf" class="btn btn-primary">Download Laporan Anak</button>
                        </div>
                    </div>

                    <hr />
                    <div id="previewArea"></div>

                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?= base_url('assets/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/vfs_fonts.js') ?>"></script>

<script>
    // Populate anak dropdown
    fetch('<?= site_url('laporan/data/anak') ?>').then(function (res) { return res.json(); }).then(function (list) {
        var sel = document.getElementById('anakSelect');
        list.forEach(function (a) {
            var opt = document.createElement('option');
            opt.value = a.id_anak || a.id || '';
            opt.text = (a.name || a.nama || '') + (a.nik ? ' - ' + a.nik : '');
            sel.appendChild(opt);
        });
    }).catch(function () { /* ignore errors populating select */ });

    document.getElementById('generatePdf').addEventListener('click', function () {
        var anakId = document.getElementById('anakSelect').value;
        if (!anakId) { alert('Pilih anak terlebih dahulu'); return; }
        var url = '<?= site_url('laporan/anak') ?>/' + anakId;

        fetch(url).then(function (res) { if (!res.ok) throw new Error(res.statusText); return res.json(); }).then(function (payload) {
            var anak = payload.anak || {};
            var ortu = payload.ortu || {};
            var visits = payload.kunjungan || [];

            var content = [];
            content.push({ text: 'Laporan Anak', style: 'title', alignment: 'center' });
            content.push({ text: '\n' });

            // Metadata table
            var metaTable = [
                [{ text: 'Nama Anak :', bold: true, alignment: 'right' }, anak.name || anak.nama || ''],
                [{ text: 'NIK :', bold: true, alignment: 'right' }, anak.nik || ''],
                [{ text: 'Nama Ibu :', bold: true, alignment: 'right' }, ortu.name_ibu || ''],
                [{ text: 'Nama Ayah :', bold: true, alignment: 'right' }, ortu.name_ayah || '']
            ];
            content.push({ table: { widths: ['30%', '*'], body: metaTable }, layout: 'noBorders' });
            content.push({ text: '\n' });

            // Visits table: Tgl Kunjungan | Fasilitas | Status Gizi | Vaksin
            var vBody = [];
            vBody.push([
                { text: 'Tgl Kunjungan', style: 'tableHeader', alignment: 'center' },
                { text: 'Fasilitas', style: 'tableHeader', alignment: 'center' },
                { text: 'Status Gizi', style: 'tableHeader', alignment: 'center' },
                { text: 'Vaksin', style: 'tableHeader', alignment: 'center' }
            ]);

            visits.forEach(function (v) {
                var peng = v.pengukuran && v.pengukuran.length ? v.pengukuran : [];
                var status = '';
                var vaks = [];
                peng.forEach(function (p) { if (p.status_gizi) status = p.status_gizi; if (p.vaksin) vaks.push(p.vaksin); });

                vBody.push([
                    { text: v.tgl_kunjungan || '-', alignment: 'center' },
                    { text: v.fasilitas || '-', alignment: 'left', margin: [2, 2, 2, 2] },
                    { text: status || '-', alignment: 'center', margin: [2, 2, 2, 2] },
                    { text: vaks.length ? vaks.join(', ') : '-', alignment: 'left', margin: [2, 2, 2, 2] }
                ]);
            });

            if (vBody.length === 1) {
                vBody.push([{ text: '-', colSpan: 4, alignment: 'center' }, {}, {}, {}]);
            }

            content.push({
                table: { headerRows: 1, widths: [80, 180, 120, 135], body: vBody },
                layout: {
                    fillColor: function (rowIndex, node, columnIndex) { return rowIndex === 0 ? '#f2f2f2' : null; },
                    hLineWidth: function (i, node) { return (i === 0 || i === node.table.body.length) ? 1.5 : 0.6; },
                    vLineWidth: function (i, node) { return 0.6; },
                    hLineColor: function (i, node) { return '#444'; },
                    vLineColor: function (i, node) { return '#444'; },
                    paddingLeft: function (i, node) { return 6; },
                    paddingRight: function (i, node) { return 6; },
                    paddingTop: function (i, node) { return 6; },
                    paddingBottom: function (i, node) { return 6; }
                }
            });

            var docDefinition = {
                pageSize: 'A4', pageMargins: [40, 60, 40, 60], content: content,
                styles: {
                    title: { fontSize: 16, bold: true, margin: [0, 0, 0, 8] },
                    tableHeader: { bold: true, fontSize: 11 }
                },
                defaultStyle: { fontSize: 10 }
            };

            try {
                var filename = 'laporan_anak_' + (anak.name || anak.nama || anak.id_anak || anak.id) + '_' + (new Date()).toISOString().slice(0, 10) + '.pdf';
                pdfMake.createPdf(docDefinition).download(filename);
            } catch (e) {
                console.warn('PDF download failed', e);
            }

        }).catch(function (err) {
            alert('Gagal mengambil data anak: ' + (err.message || err));
        });
    });
</script>