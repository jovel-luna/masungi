<template>
	<div class="cstm-calendar">
		<FullCalendar defaultView="dayGridMonth" :events="events" :plugins="calendarPlugins" :day-render="dayRender" :header="header" @dateClick="selectedDate" ref="fullCalendar"/>
    <div class="inlineBlock-parent">
      <div class="calendar__label"></div><p class="font-2">Fully Committed</p>
    </div>
	</div>
</template>

<script type="text/javascript">
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {

  props: {
    trailSelected: Object
  },

  data() {
    return {
      calendarPlugins: [ dayGridPlugin, interactionPlugin ],
      events: [],
      header: {
        center: "title",
        left: "prev",
        right: 'next'
      },

      selectedDay: null
    }
  },

  components: {
    FullCalendar // make the <FullCalendar> tag available
  },

  methods: {
    selectedDate(e) {
      this.selectedDay = moment(e.date).format('Y-MM-DD');
    },

    dayRender() {
      var el = this.$refs.fullCalendar.$el.getElementsByClassName('fc-day-top');
      _.each(this.trailSelected.blocked_dates, (date) => {
        _.each(el, (element) => {
            if($(element).attr('data-date') === date.date) {
              $(element).addClass('fc-other-month');
            }
        })
      })
    }
  }
}
</script>