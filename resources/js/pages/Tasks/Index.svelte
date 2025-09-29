<script lang="ts">
    import ContentLayout from "$lib/layouts/content-layout.svelte";
    import TaskList from "@/pages/Tasks/Partials/Task-List.svelte";
    import CreateTaskForm from "$lib/components/organisms/form/task/create-task-form.svelte";

    let {tasks, users = [], projects = []} = $props();
</script>

<ContentLayout>
    <div class="mb-4">
        <CreateTaskForm users={users} projects={projects}/>
    </div>
    <TaskList items={tasks.data} users={users} projects={projects}/>
</ContentLayout>
