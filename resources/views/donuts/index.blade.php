<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donuts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans p-6">

    <h1 class="text-3xl font-bold mb-6 text-pink-600">🍩 Donuts List</h1>

    <div id="donut-list" class="space-y-4 mb-10">Loading...</div>

    <h2 class="text-2xl font-semibold mb-2">Add Donut</h2>
    <form id="add-donut-form" enctype="multipart/form-data" class="space-y-4 max-w-md">
        <input class="w-full border border-gray-300 rounded p-2" type="text" name="name" placeholder="Donut name" required>
        <input class="w-full border border-gray-300 rounded p-2" type="number" name="price" step="0.01" placeholder="Price" required>
        <input class="w-full border border-gray-300 rounded p-2" type="number" name="seal_of_approval" min="0" max="5" placeholder="Seal (0–5)" required>
        <input class="w-full border border-gray-300 rounded p-2" type="file" name="image" accept="image/*">
        <button class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600" type="submit">Add</button>
    </form>

    <script>
        function loadDonuts() {
            fetch('/api/donuts')
                .then(res => res.json())
                .then(data => {
                    const list = document.getElementById('donut-list');
                    list.innerHTML = '';

                    if (data.data && data.data.length) {
                        data.data.forEach(donut => {
                            const item = document.createElement('div');
                            const imageHtml = donut.image
                                ? `<img src="/${donut.image}" alt="${donut.name}" class="w-24 h-24 object-cover rounded mb-2">`
                                : '';
                            item.className = "p-4 border border-gray-200 rounded bg-white shadow";
                            item.innerHTML = `
                                ${imageHtml}
                                <strong class="block text-lg font-semibold">${donut.name}</strong>
                                <span class="block">€${donut.price} - Seal: ${donut.seal_of_approval}/5</span>
                                <div class="mt-2 space-x-2">
                                    <button onclick="deleteDonut(${donut.id})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                    <button onclick="editDonut(${donut.id}, '${donut.name}', ${donut.price}, ${donut.seal_of_approval})" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</button>
                                </div>
                            `;
                            list.appendChild(item);
                        });
                    } else {
                        list.innerText = 'No donuts found';
                    }
                });
        }

        document.getElementById('add-donut-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            fetch('/api/donuts', {
                method: 'POST',
                body: formData,
            }).then(() => {
                form.reset();
                loadDonuts();
            });
        });

        function deleteDonut(id) {
            fetch(`/api/donuts/${id}`, {
                method: 'DELETE'
            }).then(() => loadDonuts());
        }

        function editDonut(id, currentName, currentPrice, currentSeal) {
            const name = prompt('New name:', currentName);
            const price = prompt('New price:', currentPrice);
            const seal = prompt('New seal (0–5):', currentSeal);

            if (name && price && seal !== null) {
                fetch(`/api/donuts/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        name: name,
                        price: price,
                        seal_of_approval: seal
                    }),
                }).then(() => loadDonuts());
            }
        }

        loadDonuts();
    </script>
</body>
</html>
