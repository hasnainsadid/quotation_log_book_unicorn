{{-- DataTables Excel / PDF export (shared) --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script>
    var EXPORT_TITLE = @json($exportTitle ?? 'Export');

    // sob (filter kora) data export korar function
    function exportAll(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;

        dt.one('preXhr', function(e, s, data) {
            data.start = 0;
            data.length = 2147483647;
            data.export = 1; // server-ke bole action column render korte hobe na

            dt.one('preDraw', function(e, settings) {
                if (button[0].className.indexOf('buttons-excel') >= 0) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config);
                }

                dt.one('preXhr', function(e, s, data) {
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });

                setTimeout(dt.ajax.reload, 0);
                return false;
            });
        });

        dt.ajax.reload();
    }

    // <br> ke new line banay, HTML tag muche, &amp; etc. thik kore
    function cleanBody(data) {
        if (typeof data !== 'string') return data;
        return data
            .replace(/<br\s*\/?>/gi, '\n')
            .replace(/<[^>]*>/g, '')
            .replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>')
            .replace(/&quot;/g, '"').replace(/&#0?39;/g, "'")
            .trim();
    }

    function fileName() {
        return EXPORT_TITLE.replace(/\s+/g, '') + '_' +
            new Date().toISOString().slice(0, 19).replace(/[-:T]/g, '');
    }

    // Excel: data cell-e Wrap Text + upor theke align (multiple value niche niche dekhabe)
    function customizeExcel(xlsx) {
        var styles = xlsx.xl['styles.xml'];
        var cellXfs = $('cellXfs', styles);
        var wrapStyle = Number(cellXfs.attr('count'));

        cellXfs.append(
            '<xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="left" vertical="top" wrapText="1"/></xf>'
        );
        cellXfs.attr('count', wrapStyle + 1);

        var sheet = xlsx.xl.worksheets['sheet1.xml'];
        $('row', sheet).each(function(i) {
            if (i >= 2) { // 0 = title, 1 = header, 2 theke data
                $('c', this).attr('s', wrapStyle);
            }
        });
    }

    // button-er design: Add New-er moto
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-primary btn-sm';

    // table ready hole Excel/PDF button banay header-e (#exportButtons) boshao
    $(document).on('init.dt', function(e, settings) {
        var $target = $('#exportButtons');
        if (!$target.length) return;

        var api = new $.fn.dataTable.Api(settings);
        var opts = {
            columns: ':visible:not(.no-export)',
            format: { body: cleanBody }
        };
        var run = function(e, dt, btn, cfg) {
            exportAll.call(this, e, dt, btn, cfg);
        };

        var buttons = new $.fn.dataTable.Buttons(api, {
            buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    title: EXPORT_TITLE,
                    filename: fileName,
                    action: run,
                    customize: customizeExcel,
                    exportOptions: opts
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    title: EXPORT_TITLE,
                    filename: fileName,
                    orientation: 'landscape',
                    pageSize: 'A3',
                    action: run,
                    exportOptions: opts
                }
            ]
        });

        buttons.container()
            .removeClass('btn-group')
            .addClass('d-flex gap-2')
            .appendTo($target);
    });
</script>