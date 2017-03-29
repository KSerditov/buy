<html>
    <head>
        <script type="text/javascript" src="./libs/jquery-3.2.0.js"></script>
        <script type="text/javascript">
            var items = 0;

            function AddItem(){
                var $input = '<div id=' + items + '><input type="text" name="item[' + items + ']"><select name="count[' + items + ']">';
                
                for(var i = 1; i < 10; i++){
                    $input += '<option value=' + i + '>' + i + '</option>';
                }

                $input += '<option value="-1">Не знаю</option></select>'
                $input += '<div id="DeleteItem">Удалить</div></div>';

                $("#dynamicItems").append($input);
                items++;
            };

            $(document).ready(function(){
                $("#Add").click(AddItem);
            });

            function DeleteItem(){
                $(this).parent("div").remove();
            };

            $(document).ready(function(){
                $('#dynamicItems').on("click","#DeleteItem",DeleteItem);
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
                           $("#Results").append(data);
                       }
                     });

                    e.preventDefault();
                })
            });

            $(document).ready(function(){
                $("#Ready").click(function(){
                    $("form#form").submit();
                });
            });

            $(document).ready(AddItem);

        </script>
        <title>Покупки</title>
    </head>
    <body>
        <form id="form" action="process.php" method="post">
            <div id="dynamicItems">
            </div>
        </form>
        <div id="Add"><p>Добавить</p></div>
        <div id="Ready"><p>Готово</p></div>
        <div id="Results"></div>
    </body>
</html>