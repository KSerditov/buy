<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <script type="text/javascript" src="./libs/jquery-3.2.0.js"></script>
        <script type="text/javascript">

            function generateSelect(item_id){
                var $r = '<select class="cntItems" name="count[' + item_id + ']">';
                    for(var i = 1; i < 10; i++){
                        $r += '<option value=' + i + '>' + i + '</option>';
                    }
                    $r += '<option value="-1">Не знаю</option>'
                    $r += '</select>';

                    return $r;
            }

            var items = 0;

            function addItem(){
                var $input = '<div id=' + items + ' class="line">'
                    $input += '<input type="text" name="item[' + items + ']" required="true">';
                    $input += generateSelect(items);
                    $input += '<div id="deleteItem">X</div>';

                    $("#dynamicItems").append($input);
                    items++;
            };

            function deleteItem(){
                $(this).parent("div").remove();
            };

            $(document).ready(function(){
                $("#add").click(addItem);
            });

            $(document).ready(function(){
                $('#dynamicItems').on("click","#deleteItem",deleteItem);
            });

            $(document).ready(function(){
                $("form#form").submit(function(e){
                    var data = $(this).serialize();
                    var url = "process.php";

                    $.ajax({
                       type: "POST",
                       url: url,
                       data: data,
                       success: function(data)
                       {
                            $("#Results").empty();
                            $("#ready").remove();
                            $("#Results").append(data);
                       }
                     });

                    e.preventDefault();
                })
            });

            $(document).ready(addItem);

            function resizeInput(){
                $(this).attr('size', $(this).val().length);
            };

        </script>
        <title>Покупки</title>
    </head>
    <body>
        <form id="form" class="form-styled" action="process.php" method="post">
            <div id="dynamicItems"></div>
            <p id="add">+ещё</p>
            <input id="ready" type="submit" value="Готово!"/>
        </form>
        <div id="Results"></div>
    </body>
</html>