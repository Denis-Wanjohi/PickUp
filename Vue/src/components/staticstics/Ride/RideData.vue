<template>
    <div class="w-screen ">
        <div class="text-center font-bold text-4xl py-3">RIDES ANALYSIS</div>
        <Splitter class="max-h-[400px]  px-5 mx-5">
            <SplitterPanel class="overflow-y-scroll">
                <RideActivities></RideActivities> 
            </SplitterPanel>
            <SplitterPanel>
                <RideChart></RideChart>
            </SplitterPanel>
        </Splitter>
    </div>
</template>