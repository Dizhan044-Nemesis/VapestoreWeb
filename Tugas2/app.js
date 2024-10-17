// Mengambil elemen DOM
const taskInput = document.getElementById('new-task');
const addButton = document.getElementById('add-btn');
const taskTable = document.getElementById('task-list');

let tasks = [];

// Fungsi untuk membuat elemen baris (row) task baru di dalam tabel
function createTaskRow(task, index) {
    const row = document.createElement('tr');
    
    // Kolom nomor
    const cellNumber = document.createElement('td');
    cellNumber.textContent = index + 1;
    
    // Kolom task/kegiatan
    const cellTask = document.createElement('td');
    cellTask.textContent = task;
    
    // Kolom untuk tombol aksi (edit dan hapus)
    const cellActions = document.createElement('td');
    
    // Tombol Edit
    const editButton = document.createElement('button');
    editButton.textContent = 'Edit';
    editButton.classList.add('edit-btn');
    editButton.onclick = () => editTask(index);

    // Tombol Hapus
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Hapus';
    deleteButton.classList.add('delete-btn');
    deleteButton.onclick = () => deleteTask(index);

    cellActions.appendChild(editButton);
    cellActions.appendChild(deleteButton);

    row.appendChild(cellNumber);
    row.appendChild(cellTask);
    row.appendChild(cellActions);
    
    return row;
}

// Fungsi untuk menampilkan semua task di tabel
function renderTasks() {
    taskTable.innerHTML = ''; // Kosongkan tabel sebelum render ulang
    tasks.forEach((task, index) => {
        const newRow = createTaskRow(task, index);
        taskTable.appendChild(newRow);
    });
}

// Fungsi untuk menambah task baru
function addTask() {
    const taskText = taskInput.value.trim(); // Mengambil nilai input
    if (taskText !== '') { // Pastikan input tidak kosong
        tasks.push(taskText); // Masukkan task ke dalam array tasks
        taskInput.value = ''; // Kosongkan input setelah menambahkan task
        renderTasks(); // Render ulang daftar task
    }
}

// Fungsi untuk mengedit task
function editTask(index) {
    const newTask = prompt('Edit kegiatan:', tasks[index]); // Prompt untuk mengedit task
    if (newTask !== null && newTask.trim() !== '') { // Jika input valid
        tasks[index] = newTask.trim(); // Perbarui task di array
        renderTasks(); // Render ulang daftar task
    }
}

// Fungsi untuk menghapus task
function deleteTask(index) {
    tasks.splice(index, 1); // Hapus task dari array
    renderTasks(); // Render ulang daftar task
}

// Event listener untuk menambah task ketika tombol "Tambahkan" diklik
addButton.addEventListener('click', addTask);

// Tambahan: Input task menggunakan tombol Enter
taskInput.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        addTask();
    }
});

// Render pertama kali
renderTasks();
