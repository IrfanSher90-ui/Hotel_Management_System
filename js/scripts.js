console.log('Scripts loaded');

  document.getElementById('searchInput').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#bookingsTable tbody tr');

    rows.forEach(row => {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(filter) ? '' : 'none';
    });
  });

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    AOS.init({
      duration: 1000,
      once: true
    });