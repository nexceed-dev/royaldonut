<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donuts</title>
</head>
<body>
    <h1>🍩 Donuts List</h1>
    <div id="donut-list">Loading...</div>

    <script>
        fetch('/api/donuts')
            .then(res => res.json())
            .then(data => {
                const list = document.getElementById('donut-list');
                list.innerHTML = '';

                if (data.data && data.data.length) {
                    data.data.forEach(donut => {
                        const item = document.createElement('div');
                        item.innerHTML = `<strong>${donut.name}</strong> - €${donut.price} - Seal: ${donut.seal_of_approval}/5`;
                        list.appendChild(item);
                    });
                } else {
                    list.innerText = 'No donuts found';
                }
            });
    </script>
</body>
</html>
