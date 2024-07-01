<?php
include 'connect.php'; 


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

$rows = array(); 

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row; 
    }
} else {
    echo "0 results";
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="w-screen h-screen">
        <div class="flex justify-center items-center h-screen">
            <div class="w-3/4">
                <div class="overflow-x-auto">
                    <div>
                     <input id="Country" placeholder="Country.." class="border p-2 bg-white outline-none rounded-md"  type="search" name="" id="">
                    </div>
                    <table class="table-auto w-full bg-white shadow-md rounded my-6">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Customer ID</th>
                                <th class="py-3 px-6 text-left">Customer Name</th>
                                <th class="py-3 px-6 text-left">Contact Name</th>
                                <th class="py-3 px-6 text-left">Address</th>
                                <th class="py-3 px-6 text-left">City</th>
                                <th class="py-3 px-6 text-left">Postal Code</th>
                                <th class="py-3 px-6 text-left">Country</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm ">
                            <?php foreach ($rows as $row): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap"><?php echo $row['ID']; ?></td>
                                    <td class="py-3 px-6 text-left"><?php echo $row['Name']; ?></td>
                                    <td class="py-3 px-6 text-left"><?php echo $row['Contact']; ?></td>
                                    <td class="py-3 px-6 text-left"><?php echo $row['Address']; ?></td>
                                    <td class="py-3 px-6 text-left"><?php echo $row['City']; ?></td>
                                    <td class="py-3 px-6 text-left"><?php echo $row['Postalcode']; ?></td>
                                    <td class="py-3 px-6 text-left"><?php echo $row['Country']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputCountry = document.getElementById('Country');
        const rows = document.querySelectorAll('tbody tr');

        inputCountry.addEventListener('input', function() {
            const filter = inputCountry.value.toLowerCase(); 
            rows.forEach(row => {
                const country = row.querySelector('td:nth-child(7)').textContent.toLowerCase(); 
                if (country.includes(filter)) {
                    row.style.display = ''; 
                } else {
                    row.style.display = 'none'; 
                }
            });
        });
    });
</script>

</html>
