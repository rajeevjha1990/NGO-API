
<div class="content">
<canvas id="allMedicinesChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
fetch("<?= base_url('dashboard/historyData') ?>")
  .then(res => res.json())
  .then(data => {
    let grouped = {};

    // Group by medicine_name
    data.history.forEach(item => {
      if (!grouped[item.medicine_name]) grouped[item.medicine_name] = { months: [], purchases: [], sales: [] };
      grouped[item.medicine_name].months.push(item.month);
      grouped[item.medicine_name].purchases.push(item.total_purchase);
      grouped[item.medicine_name].sales.push(item.total_sale);
    });

    let labels = [...new Set(data.history.map(i => i.month))]; // all months
    let datasets = [];

    Object.keys(grouped).forEach((med, index) => {
      datasets.push({
        label: med + " Purchase",
        data: labels.map(m => {
          let idx = grouped[med].months.indexOf(m);
          return idx >= 0 ? grouped[med].purchases[idx] : 0;
        }),
        backgroundColor: 'rgba(54, 162, 235, 0.6)'
      });
      datasets.push({
        label: med + " Sale",
        data: labels.map(m => {
          let idx = grouped[med].months.indexOf(m);
          return idx >= 0 ? grouped[med].sales[idx] : 0;
        }),
        backgroundColor: 'rgba(255, 99, 132, 0.6)'
      });
    });

    new Chart(document.getElementById('allMedicinesChart'), {
      type: 'bar',
      data: {
        labels: labels,
        datasets: datasets
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Monthly Sale & Purchase (All Medicines)'
          }
        }
      }
    });
  });
</script>
