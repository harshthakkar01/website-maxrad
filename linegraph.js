$(document).ready(function(){
    $.ajax({
        url: "http://localhost/generategraph.php",
        type: "GET",
        success: function(data){
            console.log(data);
            var x = [];
            var y = [];

            for(var i in data){
                x.push(data[i].x);
                y.push(data[i].y);
            }
            
            var chartdata={
                labels: x,
                datasets:[
                    {
                        label: "Sample",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(59, 89, 152, 0.75)",
                        borderColor: "rgba(59, 89, 152,1)",
                        data: y

                    }
                ]
            };
            var ctx = $('#mycanvas');
            var LineGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata
            });
        },
        error: function(data){
		console.log(data);
        }
    });
})