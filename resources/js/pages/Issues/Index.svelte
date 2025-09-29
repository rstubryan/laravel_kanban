<script lang="ts">
    import ContentLayout from "$lib/layouts/content-layout.svelte";
    import IssueList from "@/pages/Issues/Partials/Issue-List.svelte";
    import CreateIssueForm from "$lib/components/organisms/form/issue/create-issue-form.svelte";

    let {issues, tasks = [], users = []} = $props();
</script>

<ContentLayout>
    <div class="mb-4">
        <CreateIssueForm tasks={tasks} users={users}/>
    </div>
    <IssueList items={issues.data} tasks={tasks} users={users}/>
</ContentLayout>
