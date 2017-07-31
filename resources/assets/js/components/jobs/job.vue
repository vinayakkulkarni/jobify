<template>
	<div>
	<breadcrumbs 
		:breadcrumbs="this.breadcrumbs" 
		:icon="'suitcase grey icon'"
		:discardbutton="{ 'name' : 'jobs' }"
		:applybutton="{ 'name': 'job.apply', params: { id: this.id }}">
	</breadcrumbs>
	<div class="ui container stackable grid">
		<div class="sixteen wide column" v-if="this.loading">
	    <div class="ui segment" style="height:200px;">
	      <div class="ui inverted dimmer" :class="{active: loading}">
	      <div class="ui text large loader">Loading</div>
	      </div>
	    </div>
	  </div>
		<div class="sixteen wide column" v-if="!this.loading">
			<div class="ui items">
			  <div class="item">
			    <div class="content">
			      <h4 class="header">{{ job.title }} &mdash; {{ job.type }}</h4>
			      <div class="description">
			        {{ job.description }}
			      </div>
			      <div class="extra">
			        Salary: {{ job.salary}}
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
import breadcrumbs from '../breadcrumbs.vue';
export default {
	props: ['id'],
	components: { breadcrumbs },
	created() {
		if (this.id) {
			this.loadData();
		}
	},
	data() {
  	return {
  		loading: false,
  		job: {},
  		breadcrumbs: [{ 'url': 'jobs', 'name': 'Jobs' }],
  	}
	},
	methods: {
		loadData() {
			let t = this;
			NProgress.start();
			t.loading = true;
			t.$http.get('/api/v1/jobs/' + t.id, {auth: {username: 'demo@example.com', password: 123456 }})
					.then( response => { 
						t.job = response.data; 
						t.breadcrumbs = [{ 'url': 'jobs', 'name': 'Jobs' }, { 'url': 'jobs.show', 'name': t.job.title }];
						NProgress.done(true);
						t.loading = false;
						Vue.toasted.success('Job Loaded!');
					});
		}
	}
}
</script>