import quill from "./quill";

require('./bootstrap');

import FileUpload from "mdb-file-upload"
window.fileupload = FileUpload;
import Datatable from "mdb-data-parser"
window.datatable = Datatable
import Wysiwyg from "mdb-wysiwyg-editor"
window.wysiwyg = Wysiwyg
import { Calendar } from "@fullcalendar/core"
window.Calendar = Calendar
import dayGridPlugin from '@fullcalendar/daygrid'
window.dayGridPlugin = dayGridPlugin
import listPlugin from '@fullcalendar/list'
window.listPlugin = listPlugin
import googleCalendarPlugin from '@fullcalendar/google-calendar'
window.googleCalendarPlugin = googleCalendarPlugin
import bootstrap5Plugin from '@fullcalendar/bootstrap5'
window.bootstrap5Plugin = bootstrap5Plugin

require('./quill.js');

window.Quill = quill;


// Permissions Table
window.getPermissions = function() {
    const columns = [
        {label: 'Name', field: 'name'},
        {label: 'Last Updated', field: 'updated_at'},
    ];
    const asyncTable = new mdb.Datatable(
        document.getElementById('permissions-datatable'),
        { columns,}
    );
    fetch('/api/getPermissions')
        .then((response) => response.json())
        .then((data) => {
            asyncTable.update(
                {
                    rows: data.map((row) => ({
                        ...row,
                        name: row.name,
                        updated_at: new Date(row.updated_at).toLocaleString("en-US", {timeZoneName: "short"}),
                    })),
                },
                { loading: false }
            );
        });
    document.getElementById('permission-search').addEventListener('input', (e) => {
        asyncTable.search(e.target.value)
    });
}


