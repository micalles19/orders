class CustomDataTable {
  table = null;

  constructor({
    id,
    leftAlignColumns = [],
    unsortableColumns = [],
    responsive = false,
    searching = true,
    aditionalOptions = {},
    selectableRow = true,
    selectedRowClass = "selected",
    headerFiltering = false,
    columnsFilteringExceptions = [],
    dbClickCallback = null,
    onDraw = function () {},
  }) {
    this.id = id;
    this.leftAlignColumns = leftAlignColumns;
    this.unsortableColumns = unsortableColumns;
    this.responsive = responsive;
    this.searching = searching;
    this.aditionalOptions = aditionalOptions;
    this.selectableRow = selectableRow;
    this.selectedRowClass = selectedRowClass;
    this.headerFiltering = headerFiltering;
    this.columnsFilteringExceptions = columnsFilteringExceptions || [];
    this.dbClickCallback = dbClickCallback;
    this.onDraw = onDraw;

    this.#init(selectedRowClass);
  }

  #init(selectedRowClass = "selected") {
    let aditionalOptions = { ...this.aditionalOptions };

    if (aditionalOptions.columnDefs) {
      aditionalOptions.columnDefs = [
        ...aditionalOptions.columnDefs,
        {
          targets: this.leftAlignColumns,
          className: "text-start",
        },
        {
          orderable: false,
          targets: this.unsortableColumns,
        },
      ];
    } else {
      aditionalOptions.columnDefs = [
        {
          targets: this.leftAlignColumns,
          className: "text-start",
        },
        {
          orderable: false,
          targets: this.unsortableColumns,
        },
      ];
    }

    if (this.headerFiltering) {
      $(`#${this.id} thead tr`)
        .clone(true)
        .addClass("filters")
        .appendTo(`#${this.id} thead`);
      aditionalOptions.orderCellsTop = true;
      var tableId = this.id;
      var columnsFilteringExceptions = this.columnsFilteringExceptions;
      aditionalOptions.initComplete = function () {
        var api = this.api();

        api
          .columns()
          .eq(0)
          .each(function (colIdx) {
            var cell = $(`#${tableId} .filters th`).eq(
              $(api.column(colIdx).header()).index()
            );
            var title = $(cell).text();

            if (!columnsFilteringExceptions.includes(colIdx)) {
              $(cell).html(
                '<input type="text" class="form-control form-control-sm" placeholder="' +
                  title +
                  '" />'
              );
              $(cell).css("padding-right", "4.8px");
            } else {
              $(cell).html("");
            }

            $(
              "input",
              $(`#${tableId} .filters th`).eq(
                $(api.column(colIdx).header()).index()
              )
            )
              .off("keyup change")
              .on("change", function (e) {
                $(this).attr("title", $(this).val());
                var regexr = "({search})";

                var cursorPosition = this.selectionStart;

                api
                  .column(colIdx)
                  .search(
                    this.value != ""
                      ? regexr.replace("{search}", this.value)
                      : "",
                    this.value != "",
                    this.value == ""
                  )
                  .draw();
              })
              .on("keyup", function (e) {
                e.stopPropagation();

                $(this).trigger("change");
              });
          });
      };
    }

    this.table = $(`#${this.id}`)
      .DataTable({
        responsive: this.responsive,
        searching: this.searching,
        ...aditionalOptions,
      })
      .on("draw", this.onDraw);

    if (this.dbClickCallback) {
      $(`#${this.id} tbody`).on("dblclick", "tr", (e) => {
        const rowId = $(e.currentTarget).attr("id");
        this.dbClickCallback(rowId);
      });
    }

    if (this.selectableRow) {
      $(`#${this.id} tbody`).on("click dblclick", "td", function () {
        const lastColumnIndex = $(this).siblings().length;

        if (
          $(this).closest("tr").attr("id") &&
          $(this).index() !== lastColumnIndex
        ) {
          $(this)
            .closest("table")
            .find("tr")
            .not($(this).closest("tr"))
            .removeClass(selectedRowClass);

          $(this).closest("tr").toggleClass(selectedRowClass);
        }
      });
    }
  }

  addRow({ data, rowId }) {
    this.table.row.add(data).draw().node().id = rowId;

    return this;
  }

  updateRow({ data, rowId }) {
    let row = this.table.row(`#${rowId}`),
      index = row.index();

    for (let key in data) {
      this.table.cell(index, key).data(data[key]);
      $(`#${rowId}`).find(`td:eq(${key})`).html(data[key]);
    }

    return this;
  }

  deleteRow({ rowId }) {
    this.table.row(`#${rowId}`).remove().draw();
    return this;
  }

  clear() {
    this.table.clear().draw();
    return this;
  }

  redraw() {
    // this.table.draw(false)
    // this.table.columns.adjust().draw();
    // if (this.responsive) {
    //   this.table.responsive.recalc();
    // }
  }

  destroy() {
    this.table.destroy();
  }
}

export default CustomDataTable;
