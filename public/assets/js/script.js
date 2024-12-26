class myTable {

    static getButtons(options) {
        return [

            {
                extend: 'copy',
                text: 'Copy',
                className: '',
                exportOptions: {
                    columns: ':visible:not(.do_not_export)'
                }
            },

            // {
            //     extend: 'csv',
            //     text: '<i class="bi bi-filetype-csv"></i>',
            //     className: '',
            //     exportOptions: {
            //         columns: ':visible:not(.do_not_export)'
            //     },

            // }, 

            {
                extend: 'excel',
                text: 'Export',
                className: '',
                title: options.exportTitle ?? document.title,
                exportOptions: {
                    columns: ':visible:not(.do_not_export)'
                },

            },

            {
                extend: 'pdf',
                text: 'PDF',
                className: '',
                title: options.exportTitle ?? document.title,
                exportOptions: {
                    columns: ':visible:not(.do_not_export)'
                },
                orientation: 'landscape',
                customize: function (doc) {
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');  // Make Pdf full width


                    //--------------Title -------------------
                    doc.styles.title.fontSize = 19
                    doc.styles.tableHeader.padding = 5
                    //--------------Title -------------------

                    //--------------Heading -------------------
                    doc.styles.tableHeader.alignment = 'left'
                    doc.styles.tableHeader.margin = [4, 2, 2, 2]
                    //--------------Heading -------------------

                    //--------------Body -------------------
                    doc.defaultStyle.fontSize = 12
                    //--------------Body -------------------


                },
            },

            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-secondary',
                title: options.exportTitle ?? document.title,
                exportOptions: {
                    columns: ':visible:not(.do_not_export)'
                },
                footer: true,

                title: options.exportTitle ?? document.title,
                customize: function (win) {
                    // Center-align the title
                    $(win.document.body).find('h1').css('text-align', 'center');

                }

            }
        ]
    }


    /**
     * 
     * @param {object} options 
     * @returns instance
     */
    static dataTable(options = {}) {
        const selector = options.selector ?? '#dataTable';
        const exporting = options.exporting ?? true;

        const instance = new DataTable(selector, {
            // order: [[0, 'asc']],
            order: options.order ?? [],
            paging: options.paging ?? true,
            searching: options.searching ?? true,
            lengthChange: options.lengthChange ?? true,

            lengthMenu: options.lengthMenu ?? [10, 25, 50, 100, 200],
            dom: options.dom ?? '<"top"B><"bottom"fl>t<"bottom"ip><"clear">',

            // dom: 'lBfrtip',
            // dom: '<"top"B><"bottom"flp><"clear">',

            language: options.language ?? {
                search: options.searchLabel ?? 'Search:',
                searchPlaceholder: options.placeholder ?? 'Search...',
                paginate: {
                    previous: '<i class="bi bi-skip-backward"></i>',
                    next: '<i class="bi bi-fast-forward"></i>'
                },
                emptyTable: options.emptyTable ?? 'Sorry, no data available'
            },
            footerCallback: function (tfoot, data, start, end, display) {
                var api = this.api();
                var totalRows = api.rows().count();

                $(api.column(0).footer()).html('Total: ' + totalRows);
            },
            drawCallback: function (settings) {
                // tableDrawn();
            },

            lengthChange: function (e, settings) {
                // tableDrawn();
            },

            // dom: 'Bfrtip',
            buttons: exporting ? myTable.getButtons({ exportTitle: options.exportTitle ?? document.title }) : []

        });




        if (exporting) myTable.#helper();


        return instance;
    }

    static #helper() {
        $('.buttons-print').attr('title', 'Print')
        $('.buttons-csv').attr('title', 'Convert to CSV')
        $('.buttons-pdf').attr('title', 'Convert to PDF')
        $('.buttons-excel').attr('title', 'Export to Excel')
        $('.buttons-copy').attr('title', 'Copy to Clipboard')
    }


    static sticky(selector = 'table', top = Aside.header.clientHeight) {
        $(selector).stickyHeaderFooter({
            top: top
            // bottom: '20px',
        });
    }
}
