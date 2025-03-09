import './bootstrap';
import { DataTable } from "simple-datatables";
import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css'; 
import Swal from 'sweetalert2';

window.Alpine = Alpine;

Alpine.start();

AOS.init();

// Datatables
let dataTable = new DataTable("#search-table", {
    classes: {
        top: "mb-4 p-4 rounded flex flex-row justify-between", // Style bagian atas (search box)
        search: "rounded p-2 w-1/3", // Style input pencarian
        input: "rounded p-2 bg-transparent w-full", // Style form input
        table: "rounded-lg w-full", // Style tabel utama
        paginationList: "flex space-x-2 mt-4 rounded", // Style pagination
        paginationButton: "text-white rounded px-3 py-1", // Style tombol pagination
        paginationButtonCurrent: "text-white",
    },
    searchable: true,
    fixedHeight: true,
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("#delete-form").forEach(form => {
        form.addEventListener("submit", function(event) {
            event.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "Kalo hilang bakal susah balikinnya loh!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Gass!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

