<div class="header">
    <div class="time-selection">
    <select>
      <option value="day">Day</option>
      <option value="week">Week</option>
      <option value="month">Month</option>
    </select>
    </div>
    <div class="specific-time-selection">
     <select>
      <option value="April1stWeek">April 1-7</option>
      <option value="April2ndWeek">April 8-14</option>
      <option value="April3rdWeek">April 15-21</option>
      <option value="April4thWeek">April 22-28</option>
    </select>
    </div>
    <h1>APRIL 2024</h1>
    <a href="/addShift">Add Shift</a>
</div>

<div class="employee-section">
  <input type="search" id="employee-search" name="employee-search" placeholder="Search employees">
  <ul>
    <li>Employee 1</li>
    <li>Employee 2</li>
    <li>Employee 3</li>
    <!-- Add more employees as needed -->
  </ul>
  <a href="/addEmployee">Add Employee</a>
</div>

<div class="schedule-section">
  <div class="weekdays">
    <div class="day">Mon</div>
    <div class="day">Tue</div>
    <div class="day">Wed</div>
    <div class="day">Thu</div>
    <div class="day">Fri</div>
    <div class="day">Sat</div>
    <div class="day">Sun</div>
  </div>
  <div class="schedule-grid">
    <!-- Repeat this block for each employee -->
    <div class="employee-row">
      <div class="employee-name">Employee Name</div>
      <div class="time-slot">9:00 - 17:00</div>
      <!-- Add more time slots as needed -->
    </div>
    <!-- End of employee block -->
  </div>
</div>