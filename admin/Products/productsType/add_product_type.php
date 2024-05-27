<?php
require_once '../../includes/session_test.php';
include ("../../../includes/connection.php");

$adminId = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <link rel="stylesheet" href="../../assets/css/nav_sidebar.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <style>
        ul {
            padding-left: 0rem;
        }

        input,
        select {
            height: 100%;
            width: 90%;
        }

        input[type="checkbox"] {
            height: 15px;
            width: 15px;
        }

        table,
        th,
        td {
            height: 20px;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <?php include ('../../includes/sidebar.php'); ?>
    <!-- /SIDEBAR -->

    <section class="content" id="content">
        <!-- NAVBAR -->
        <?php include ('../../includes/navbar.php'); ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Add Product Type</h1>
                    <ul class="dreadleft">
                        <li>
                            <a class="active" href="../../dashboard/">Dashboard</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="../">Products</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a class="active" href="./">Products Type</a>
                        </li>
                        <li><i class="bx bx-chevron-right"></i></li>
                        <li>
                            <a href="#">Add Products Type</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div style="display: flex;flex-direction: row;justify-content: flex-end;">
                <a href="./" class="btn btn-primary bt-sm" style="display: flex; align-items: center;">Go Back</a>
            </div>
            <div class="table-data">
                <div class="order">
                    <div class="container-fluid admin">
                        <div class="col-md-12 alert alert-primary" style="text-align: center;">Products Types </div>
                        

                            <div id="table-of-contents" style="width:100%">
                                <form id="update-form" method='POST' enctype='multipart/form-data' action="process.php">
                                    <table>
                                        <tr>
                                            <td>
                                                <label>Available Category</label>
                                            </td>
                                            <td>
                                                <label for="type_name">Product Type </label>
                                            </td>

                                            <td>
                                                <input type="text" id="type_name" name="type_name" required>
                                            </td>
                                            <td>
                                                <button type="button" id="add-input"
                                                    class="btn btn-primary btn-large">Add
                                                    input</button>
                                            </td>
                                        </tr>
                                        <tr>


                                            <td>
                                                <ul
                                                    style="list-style: none;display: flex;flex-direction: column;align-items: flex-start; font-size :18px;">
                                                    <?php
                                                    // Assuming you have fetched categories from the database and stored them in $categories array
                                                    $sql = "SELECT * FROM categories";
                                                    $result = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<li style="padding:5px;">';
                                                            echo '<input type="checkbox" id="category_' . $row['CategoryID'] . '" name="category[]" value="' . $row['CategoryID'] . '" >';
                                                            echo '<label for="category_' . $row['CategoryID'] . '" style="margin-left: 5px;">' . $row['CategoryName'] . '</label>';
                                                            echo '</li>';
                                                        }
                                                    } else {
                                                        echo "<li>No categories found.</li>";
                                                    }
                                                    ?>
                                                </ul>
                                            </td>



                                            <td colspan="5">
                                                <div id="inputs-container"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <input type='submit' style='width: 140px;' name='Generate'
                                                    class='btn btn-success btn-large' value='Generate'>
                                            </td>
                                        </tr>
                                    </table>
                                    <br><br>
                                </form>
                            </div>

                        

                    </>
                </div>
            </div>
        </main>
    </section>

    <script>
        $(document).ready(function () {
            let countIndex = $('#inputs-container .input-group').length;

            function getExampleInput(type, index) {
                switch (type) {
                    case 'integer':
                        return `<input class="styleMe" type="number" id="example-${index}"  placeholder="Example: 123">`;
                    case 'decimal':
                        return `<input class="styleMe" type="number" step="0.01" id="example-${index}"  placeholder="Example: 123.45">`;
                    case 'string':
                        return `<input class="styleMe" type="text" id="example-${index}"  placeholder="Example: Sample text">`;
                    case 'boolean':
                        return `<select id="example-${index}" >
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>`;
                    case 'date':
                        return `<input class="styleMe" type="date" id="example-${index}" >`;
                    default:
                        return '';
                }
            }

            function addInputField(index, type = 'string') {
                countIndex++;
                let inputGroup = `
                <div class="input-group" id="input-group-${index}">
                    <table>
                        <tr>
                            <td style="width:8%;">
                                <label for="input-${index}">Input ${index}</label>
                            </td>
                            <td>
                                <input type="text" class="hereInput" id="input-${index}" name="inputs[${index}][value]" required>
                            </td>
                            <td style="width:15%;">
                                <select id="type-${index}" name="inputs[${index}][type]" class="type-selector" data-index="${index}">
                                    <option value="string" selected>string</option>
                                    <option value="integer" ${type === 'integer' ? 'selected' : ''}>integer</option>
                                    <option value="decimal" ${type === 'decimal' ? 'selected' : ''}>decimal</option>
                                    <option value="boolean" ${type === 'boolean' ? 'selected' : ''}>boolean</option>
                                    <option value="date" ${type === 'date' ? 'selected' : ''}>date</option>
                                </select>
                            </td>
                            <td style="width:30%;">
                                <div class="example-container" id="example-container-${index}" style="height:100%;">
                                    ${getExampleInput(type, index)}
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-remove" data-index="${index}">Remove</button>
                            </td>
                        </tr>
                    </table>
                </div>

                `;
                $('#inputs-container').append(inputGroup);
            }

            // Function to renumber inputs
            function renumberInputs() {
                let inputGroups = $('#inputs-container .input-group');
                inputGroups.each(function (newIndex) {
                    let inputGroup = $(this);
                    // Update index and attributes
                    let index = newIndex + 1;
                    inputGroup.attr('id', `input-group-${index}`);
                    inputGroup.find('label').text(`Input ${index}`);
                    inputGroup.find('label').attr('for', `input-${index}`);
                    inputGroup.find('.hereInput').attr('id', `input-${index}`).attr('name', `inputs[${index}][value]`);
                    inputGroup.find('select').attr('name', `inputs[${index}][type]`).data('index', index);
                    inputGroup.find('select').attr('id', `type-${index}`);
                    inputGroup.find('.btn-remove').data('index', index);
                    inputGroup.find('.example-container').attr('id', `example-container-${index}`);
                    inputGroup.find('.example-container input, .example-container select').attr('id', `example-${index}`);
                });
            }



            $('#add-input').click(function () {
                addInputField(countIndex + 1);
            });

            // Remove input field
            $(document).on('click', '.btn-remove', function () {
                let indexToRemove = $(this).data('index');
                $(`#input-group-${indexToRemove}`).remove();
                // Decrement countIndex
                countIndex--;
                // Renumber the remaining inputs
                renumberInputs();
            });

            $(document).on('change', '.type-selector', function () {
                let index = $(this).data('index');
                let type = $(this).val();
                let exampleInput = getExampleInput(type, index);
                $(`#example-container-${index}`).html(exampleInput);
            });
        });
    </script>
    <script src="../../assets/js/script.js"></script>
    <script>

        //update the link of the sidebar and the nav links
        $(document).ready(function () {
            $('.nav-list a').each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', '../' + href);
            });

            $('.profile-link a').each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', '../' + href);
            });
        });
    </script>
</body>

</html>