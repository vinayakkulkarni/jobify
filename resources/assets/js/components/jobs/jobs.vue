<template>
<div>
  <breadcrumbs 
    :breadcrumbs="[{ 'url': 'jobs', 'name': 'Jobs' }]" 
    :icon="'suitcase grey icon'">
  </breadcrumbs>
  <div class="ui container stackable grid">
    <div class="sixteen wide column" v-if="this.loading">
      <div class="ui segment" style="height:200px;">
        <div class="ui inverted dimmer" style="width:100% !important;" :class="{active: loading}">
        <div class="ui text large loader">Loading</div>
        </div>
      </div>
    </div>
    <div class="sixteen wide column" v-if="!this.loading">
      <h3 class="ui horizontal divider header">
        Why Us ?
      </h3>
      <div class="ui green segment">
        <div class="ui two column stackable grid">
          <div class="column">
            <h3 class="ui header">JOIN OUR INTERNATIONAL TEAM</h3>
            <div class="sub header">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in ex blandit, feugiat neque eu, ullamcorper leo. Pellentesque nisl est, auctor. Vestibulum dignissim mi id ornare mattis. Maecenas feugiat venenatis cursus.
            </div>
            <div class="ui divider"></div>
            <div>
              <i class="check green icon"></i> Phasellus in nisl eu augue molestie feugiat. <br />
              <i class="check green icon"></i> Quisque cursus orci posuere justo eleifend. <br />
              <i class="check green icon"></i> Etiam auctor sem nec lorem ullamcorper elementum. <br />
            </div>
          </div>
          <div class="column">
            <div v-accordion class="ui styled fluid accordion">
              <div class="active title">
                <i class="dropdown icon"></i>
                WE FOCUS ON OUR CLIENTS
              </div>
              <div class="active content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae massa et augue pharetra facilisis. Ut ac lacinia dolor. Praesent sed leo et dui rhoncus finibus vel pulvinar nisl.</p>
              </div>
              <div class="title">
                <i class="dropdown icon"></i>
                WE VALUE OUR PEOPLE
              </div>
              <div class="content">
                <p>There are many breeds of dogs. Each breed varies in size and temperament. Owners often select a breed of dog that they find to be compatible with their own lifestyle and desires from a companion.</p>
              </div>
              <div class="title">
                <i class="dropdown icon"></i>
                WE REWARD SUCCESS
              </div>
              <div class="content">
                <p>Three common ways for a prospective owner to acquire a dog is from pet shops, private owners, or shelters.</p>
                <p>A pet shop may be the most convenient way to buy a dog. Buying a dog from a private owner allows you to assess the pedigree and upbringing of your dog before choosing to take it home. Lastly, finding your dog from a shelter, helps give a good home to a dog who may not find one so readily.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <h3 class="ui horizontal divider header">
        Listings
      </h3>
      <div class="ui four stackable cards" style="padding-top:10px;" v-if="jobs.length > 0">
        <div class="card" v-for="(job, index) in jobs" :key="job.id">
          <div class="content">
            <div class="header">
              {{ job.title }}
            </div>
            <div class="meta">
              Type: {{ job.type }}
            </div>
            <div class="description">
              {{ job.description }}
            </div>
          </div>
          <div class="extra content">
            Company: {{ job.employer }}
          </div>
          <div class="extra content">
            <div class="ui two buttons">
              <router-link
                tag="button"
                class="ui grey basic purple button"
                :to="{ name: 'jobs.show', params: { id: job.id }}" exact>
                View Job
              </router-link>
              <router-link
                  tag="button"
                  class="ui grey basic button"
                  :to="{ name: 'job.apply', params: { id: job.id }}" exact>
                  Apply
                </router-link>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        No Jobs Available!
      </div>
    </div>
  </div>
</div>
</template>
<script>
import breadcrumbs from '../breadcrumbs.vue';
export default {
  components: { breadcrumbs },
  data() {
    return {
      loading: false,
      jobs: [],
    }
  },
  created() {
  	this.loadData();
  },
  mounted() {
    document.title = "Jobify :: List All Jobs";
  },
  methods: {
    loadData() {
      let t = this;
      this.loading = true;
      NProgress.start();
      this.$http.get('/api/v1/jobs', {auth: {username: 'demo@example.com', password: 123456 }})
          .then(response => {
            console.log('reseponse.data', response.data);
            t.jobs = response.data;
            t.loading = false;
            NProgress.done(true);
          });
    }
  }
}
</script>