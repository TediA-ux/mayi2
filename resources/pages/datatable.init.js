/**
 * Theme: Unikit - Responsive Bootstrap 5 Admin Dashboard
 * Author: Mannatthemes
 * Datatables Js
 */
const dataTable = new simpleDatatables.DataTable("#datatable_1", {
    searchable: true,
    fixedHeight: false,
})

const dataTable_3 = new simpleDatatables.DataTable("#datatable_3", {
    searchable: true,
    fixedHeight: false,
})


const dataTable_4 = new simpleDatatables.DataTable("#datatable_4", {
    searchable: true,
    fixedHeight: false,
})

const dataTable_5 = new simpleDatatables.DataTable("#datatable_5", {
    searchable: true,
    fixedHeight: false,
})

const dataTable_2 = new simpleDatatables.DataTable("#datatable_2")
document.querySelector("button.csv").addEventListener("click", () => {
    dataTable_2.export({
        type: "csv",
        download: true,
        lineDelimiter: "\n\n",
        columnDelimiter: ";"
    })
})
document.querySelector("button.sql").addEventListener("click", () => {
    dataTable_2.export({
        type: "sql",
        download: true,
        tableName: "export_table"
    })
})
document.querySelector("button.txt").addEventListener("click", () => {
    dataTable_2.export({
        type: "txt",
        download: true,
    })
})
document.querySelector("button.json").addEventListener("click", () => {
    dataTable_2.export({
        type: "json",
        download: true,
        escapeHTML: true,
        space: 3
    })
})