<table class="journeys">
  {{# journeys}}
    <tr>
      <td>
        <table class="journey">
          <tbody>
            <tr>
              <td class="journey_date">{{date_start}}</td>
            </tr>
            <tr>
              <td class="journey_times">{{time_start}} ➟ {{time_stop}}</td>
              <td class="journey_duration">(durée : {{duration}})</td>
            </tr>
            <tr>
              <td class="journey_stations">{{station_start}} ➟ {{station_stop}}</td>
            </tr>
            <tr>
              <td>
                <table class="sections">
                  {{# sections}}
                    <tr>
                      <td>
                        <table class="section">
                          <tr>
                            <td class="section_num">{{num}}</td>
                            <td class="section_num_train">n°{{num_train}}</td>
                            <td class="section_type_train">{{type_train}}</td>
                          </tr>
                          <tr>
                            <td class="section_times">{{time_start}} ➟ {{time_stop}}</td>
                            <td class="section_duration">(durée : {{duration}})</td>
                          </tr>
                          <tr>
                            <td class="sections_stations">{{station_start}} ➟ {{station_stop}} ({{station_direction}})</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  {{/ sections}}
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  {{/ journeys}}
</table>
