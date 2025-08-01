<x-layouts.app :title="__('New Task')">
    <div class="flex  w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="gap-4">
            <div class="relative aspect-video  rounded-xl border border-neutral-200 dark:border-neutral-700 p-10">
							<form action="newtask" method="POST">
								{{ csrf_field() }}

                <div class="space-y-6 mb-5">
									 <div>
        						<flux:heading size="lg">New task</flux:heading>
        						<flux:text class="mt-2">Enter the name task and description of the task!</flux:text>
   									</div>
								</div>
								<div class="space-y-6">
        					<flux:input name="task_name" label="Task name" type="text" placeholder="Your task name" />
        					<flux:field>
            		<div class="mb-3">
                		<flux:label>Description</flux:label>
            		</div>
            				<flux:input name="task_description" type="text" placeholder="Your description" />
        					</flux:field>
    						</div>
								<div class="space-y-2 mt-3">
        					<flux:button variant="primary" class="w-full" type="submit">New Task</flux:button>
    						</div>
							</form>
            </div>
        </div>
    </div>
</x-layouts.app>
