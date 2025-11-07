class SecurityApp {
  constructor() {
    this.init();
  }

  init() {
    // Login form handling
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
      this.initLoginForm();
    }

    // Dashboard initialization
    if (document.getElementById("guardsGrid")) {
      this.initDashboard();
    }
  }

  initLoginForm() {
    const form = document.getElementById("loginForm");
    const loginBtn = document.getElementById("loginBtn");
    const errorDiv = document.getElementById("errorMessage");

    form.addEventListener("submit", async (e) => {
      e.preventDefault();

      const formData = new FormData(form);
      const email = form.querySelector('smart-input[type="email"]').value;
      const password = form.querySelector('smart-input[type="password"]').value;
      const role = Array.from(
        document.querySelectorAll('smart-radio-button[name="role"]')
      ).find((r) => r.checked).value;

      if (!email || !password) {
        this.showError("Please fill in all fields");
        return;
      }

      loginBtn.disabled = true;
      loginBtn.innerHTML = "LOGGING IN...";

      try {
        const response = await fetch("api/login.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ email, password, role }),
        });

        const data = await response.json();

        if (data.success) {
          window.location.href = "dashboard.php";
        } else {
          this.showError(data.message);
        }
      } catch (error) {
        this.showError("Network error. Please try again.");
      } finally {
        loginBtn.disabled = false;
        loginBtn.innerHTML = "LOGIN";
      }
    });
  }

  showError(message) {
    const errorDiv = document.getElementById("errorMessage");
    errorDiv.textContent = message;
    errorDiv.style.display = "block";

    setTimeout(() => {
      errorDiv.style.display = "none";
    }, 5000);
  }

  async initDashboard() {
    try {
      const response = await fetch("api/guards.php");
      const data = await response.json();

      if (data.success) {
        this.initGuardsGrid(data.data);
      } else {
        console.error("Failed to load guards data");
      }
    } catch (error) {
      console.error("Error loading guards:", error);
    }
  }

  initGuardsGrid(guardsData) {
    const grid = document.getElementById("guardsGrid");

    const dataSource = new Smart.DataAdapter({
      dataSource: guardsData,
      dataFields: [
        "id: number",
        "name: string",
        "email: string",
        "status: string",
        "last_seen: string",
      ],
    });

    grid.innerHTML = "";

    new Smart.Grid(grid, {
      dataSource: dataSource,
      columns: [
        { label: "ID", dataField: "id", width: 60 },
        { label: "Name", dataField: "name", width: 200 },
        { label: "Email", dataField: "email", width: 250 },
        {
          label: "Status",
          dataField: "status",
          width: 100,
          template: function (formatObject) {
            const status = formatObject.value;
            const color = status === "active" ? "#4CAF50" : "#F44336";
            return `<span style="color: ${color}; font-weight: bold">${status.toUpperCase()}</span>`;
          },
        },
        { label: "Last Seen", dataField: "last_seen", width: 150 },
      ],
      sorting: {
        enabled: true,
      },
      filtering: {
        enabled: true,
      },
      paging: {
        enabled: true,
        pageSize: 10,
      },
    });
  }
}

// Initialize app when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  new SecurityApp();
});
