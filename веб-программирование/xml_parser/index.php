<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border: 2px solid black;
            margin: 10px;
        }

        td{
            border: 2px solid black;
        }
        .address, .items{
            width: 100%;
            display: flex;
        }
    </style>
</head>
<body>
    <?php
        function add_record($key, $data){
            return '<tr>' . "<td class='key'>". $key . "</td>" . "<td class='data'>". $data . "</td>" . '</tr>';
        }

        function table_from_dict($dict, $tb_name){
            $table = "<table><thead><th>$tb_name</th></thead>";
            foreach($dict as $key => $value){
                $table .= add_record($key, $value);
            }
            $table .= '</table>';
            return $table;
        }

        $file = fopen('data.xml', 'r');
        $data = simplexml_load_file("data.xml");

        $main_data = [];

        $main_data["PurchaseOrderNumber"] = $data["PurchaseOrderNumber"];
        $main_data["OrderDate"] = $data["OrderDate"];

        echo table_from_dict($main_data, "Main data");

        echo '<div class="address">';
        foreach ($data->Address as $arr){
            $addres_data = [];
            $addres_data["Type"] = $arr["Type"];
            foreach($arr as $key => $value){
                $addres_data[$key] = $value;
            }
            echo table_from_dict($addres_data, "Address data");
        }
        echo '</div>';

        echo table_from_dict(['Notes' => $data->DeliveryNotes], "Notes data");
        
        echo '<div class="items">';
        foreach ($data->Items as $arr){
            $item_data = [];
            foreach($arr->Item as $item){
                foreach($item as $key => $value){
                    $item_data[$key] = $value;
                }
               echo table_from_dict($item_data, 'Item data');
            }
        }
        echo '</div>';
    ?>
</body>
</html>
