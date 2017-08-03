<template>
	<div>
		<breadcrumbs :breadcrumbs="this.breadcrumbs" :icon="'suitcase grey icon'" :discardbutton="{ 'name' : 'applications' }">
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
							<h4 class="header">
								{{ application.name }} &mdash; {{ application.email }}
							</h4>
							<div class="description">
								{{ application.web_address }}
							</div>
							<div class="extra">
								Cover: {{ application.cover}}
							</div>
							<h4 class="header">
								Resume &mdash; {{ application.resume }}
								<rating v-model="application.rating" :disabled="disableRating"></rating>
							</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="sixteen wide right aligned column" v-if="!this.loading">
				<button class="ui primary button" v-if="!disableRating" @click.once="submitRating">Save</button>
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
		this.loadData();
	},
	mounted() {
		document.title = "Jobify :: View Application";
	},
	data() {
		return {
			loading: false,
			application: {},
			disableRating: false,
			breadcrumbs: [{ 'url': 'jobs', 'name': 'Jobs' }, { 'url': 'applications', 'name': 'Applications' }],
		}
	},
	methods: {
		loadData() {
			let t = this;
			NProgress.start();
			t.loading = true;
			t.$http.get('/api/v1/applications/' + t.id, { auth: { username: 'demo@example.com', password: 123456 } })
				.then(response => {
					t.application = response.data;
					t.loading = false;
					t.breadcrumbs = [{ 'url': 'jobs', 'name': 'Jobs' }, { 'url': 'applications', 'name': 'Applications' }, { 'url': 'applications.show', 'name': t.application.name }];
					Vue.toasted.success('Application loaded successfully!');
					NProgress.done(true);
				})
				.catch(error => {
					Vue.toasted.error('Application loaded unsucessfully, going to previous page!');
					t.$router.go(-1);
				});
		},
		submitRating() {
			let t = this;
			NProgress.start();
			t.loading = true;
			t.$http.post('/api/v1/applications/' + this.id, t.application, { auth: { username: 'demo@example.com', password: 123456 } })
				.then(response => {
					t.loading = false;
					NProgress.done(true);
					t.disableRating = true;
					Vue.toasted.success('Successfully rated application!');
				})
				.catch(error => {
					Vue.toasted.error('Unable to perform action');
					t.$router.push({ name: 'applications' });
				});
		}
	}
}
</script>