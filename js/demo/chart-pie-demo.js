// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example

// ใช้ Fetch API


fetch('getData.php')
  .then(response => response.json())
  .then(data => {
    var fetchData = Object.values(data);
    console.log(fetchData); // แสดงข้อมูลในคอนโซล
    var Loglabel = Object.keys(data);
    console.log(Loglabel);

    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: Loglabel,
        datasets: [{
          data: fetchData,
          backgroundColor: ['#1cc88a', '#36b9cc', '#f6c23e'],
          hoverBackgroundColor: ['#1cc88a', '#36b9cc', '#f6c23e'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });
  })
  .catch(error => console.error('เกิดข้อผิดพลาด:', error));





