<div class="mt-20 mb-10">
  @if( empty($block->body) )
    <div class="mx-auto max-w-3xl px-8">
      <h1 class="kop text-center">{{ $block->heading }}</h1>
    </div>
  @else
    <div class="mx-auto max-w-4xl px-8">
      <h1 class="kop">{{ $block->heading }}</h1>
      <p>{!! nl2br($block->body) !!}</p>
      <x-buttonbar :actions="$block->actions" class="mt-6" />
    </div>
  @endif
</div>
<div class="my-10 py-10 bg-wit dark:bg-blauw">
  <div class="mx-auto max-w-3xl px-8 flex justify-center flex-wrap items-center gap-x-6 gap-y-2">
    <img src="/images/partners/lifelines.png" alt="Lifelines" />
    <img src="/images/partners/erasmusmc.png" alt="Erasmus MC" />
    <img src="/images/partners/muvienna.png" alt="MU Vienna" />
    <img src="/images/partners/pluut.png" alt="Pluut & Partners" />
    <img src="/images/partners/tudelft.png" alt="TU Delft" />
    <img src="/images/partners/mecvs.png" alt="ME/CVS Stichting" />
    <img src="/images/partners/rug.png" alt="Rijkuniversiteit Groningen" />
    <img src="/images/partners/umcg.png" alt="UMCG" />
    <img src="/images/partners/zonmw.png" alt="ZonMw" />
  </div>
</div>