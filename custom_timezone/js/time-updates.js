


(function ($) {

  var desiredTimezone = drupalSettings.custom_timezone.timezone; // Replace with your desired timezone.

  // Function to format the time in the specified timezone.
  function formatTimeInTimezone(now, timezone) {
    var options = { timeZone: timezone, hour12: true, hour: 'numeric', minute: 'numeric' };
    return now.toLocaleTimeString('en-US', options);
  }

  // Function to update the time in the specified timezone.
  function updateTimeInTimezone(timezone) {
    var currentTimeElement = $('#current-time');
    var now = new Date();
    var formattedTime = formatTimeInTimezone(now, timezone); // Format the time in the specified timezone.
    currentTimeElement.text(formattedTime);
  }

  updateTimeInTimezone(desiredTimezone);

  // Schedule periodic updates (e.g., every minute).
  setInterval(function () {
    updateTimeInTimezone(desiredTimezone);
  }, 60000); // 60,000 milliseconds = 1 minute
})(jQuery);
