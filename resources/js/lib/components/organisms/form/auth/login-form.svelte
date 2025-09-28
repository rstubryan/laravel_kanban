<script lang="ts">
    import * as Card from "$lib/components/ui/card";
    import {Button} from "$lib/components/ui/button";
    import {Input} from "$lib/components/ui/input";
    import {Label} from "$lib/components/ui/label";
    import {Form, Link, useForm} from '@inertiajs/svelte'

    const form = useForm({
        email: '',
        password: ''
    });
</script>

<Card.Root class="mx-auto w-full max-w-sm">
    <Card.Header>
        <Card.Title class="text-2xl">Login</Card.Title>
        <Card.Description>Enter your email below to login to your account</Card.Description>
    </Card.Header>
    <Card.Content>
        <Form action="/login" method="post" {form} let:errors let:processing>
            <div class="grid gap-4">
                <div class="grid gap-2">
                    <Label for="email">Email</Label>
                    <Input id="email" name="email" type="email" placeholder="m@example.com" required
                    />
                    {#if errors.email}
                        <div class="text-red-500 text-sm">{errors.email}</div>
                    {/if}
                </div>
                <div class="grid gap-2">
                    <div class="flex items-center">
                        <Label for="password">Password</Label>
                    </div>
                    <Input id="password" name="password" type="password" required/>
                </div>
                <Button type="submit" class="w-full" disabled={processing}>Login</Button>
                <Button variant="outline" class="w-full">
                    Login with Google
                </Button>
            </div>
        </Form>
        <div class="mt-4 text-center text-sm">
            Don't have an account?
            <Link href="/register" class="underline"> Sign up</Link>
        </div>
    </Card.Content>
</Card.Root>
