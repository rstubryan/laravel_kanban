<script>
    import {Button} from "$lib/components/ui/button";
    import {Form} from "@inertiajs/svelte";
    import ContentLayout from "$lib/layouts/content-layout.svelte";
</script>

<ContentLayout>
    <Form action="/auth/logout" method="delete">
        <Button type="submit">Logout</Button>
    </Form>
</ContentLayout>
