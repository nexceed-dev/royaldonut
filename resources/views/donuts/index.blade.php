<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donuts</title>
</head>
<body>
    <h1>🍩 Donuts List</h1>

    <div id="donut-list">Loading...</div>

    <h2>Add Donut</h2>
    <form id="add-donut-form">
        <input type="text" name="name" placeholder="Donut name" required>
        <input type="number" name="price" step="0.01" placeholder="Price" required>
        <input type="number" name="seal_of_approval" min="0" max="5" placeholder="Seal (0-5)" required>
        <button type="submit">Add</button>
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
                            item.innerHTML = `
                                <strong>${donut.name}</strong> - €${donut.price} - Seal: ${donut.seal_of_approval}/5
                                <button onclick="deleteDonut(${donut.id})">Delete</button>
                                <button onclick="editDonut(${donut.id}, '${donut.name}', ${donut.price}, ${donut.seal_of_approval})">Edit</button>
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
            const data = {
                name: form.name.value,
                price: form.price.value,
                seal_of_approval: form.seal_of_approval.value,
            };

            fetch('/api/donuts', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data),
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
