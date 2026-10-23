<?php get_header(); ?>
<main id="main">
<section class="hero center">
  <div class="wrap">
    <span class="eyebrow"><i></i>AI + Human · Surge-proof</span>
    <h1>People first. <span class="grad">AI when it's busy.</span></h1>
    <p class="lead">Callers talk to trained Executel agents. The moment call volume climbs past capacity, AI picks up the overflow automatically, so nobody waits and nothing is missed.</p>
    <div class="actions"><a class="btn primary" href="#demo">Talk to our team →</a><a class="btn ghost" href="#modes">Compare options</a></div>
    <div class="trust" style="justify-content:center"><span>Human-first experience</span><span>Automatic overflow</span><span>One number, one brand voice</span></div>
  </div>
</section>

<section id="modes" style="padding-top:20px">
  <div class="wrap">
    <div class="sec-head c reveal"><span class="eyebrow">Flexible coverage</span><h2>Three ways to answer, one platform</h2><p>Switch modes any time or schedule them by hour, day or campaign.</p></div>
    <div class="grid g3 modes">
      <div class="card reveal"><div class="ico">🤖</div><h3>AI only</h3><p>Every call handled by AI agents.</p><ul class="ticks"><li>Lowest cost per call</li><li>Instant, unlimited capacity</li><li>Great for routine requests</li></ul><a class="link" href="<?php echo esc_url(executel_url('ai-agents')); ?>">See AI only →</a></div>
      <div class="card feat reveal"><span class="tag">Overflow</span><div class="ico" style="margin-top:12px">🤝</div><h3>AI + Human</h3><p>Humans answer first. AI joins when volume is high.</p><ul class="ticks"><li>Human touch by default</li><li>Zero queue during surges</li><li>Pay for AI only when used</li></ul></div>
      <div class="card reveal"><div class="ico">🎧</div><h3>Human only</h3><p>Live Executel agents, 24/7.</p><ul class="ticks"><li>Best for sensitive calls</li><li>Custom scripts & escalation</li><li>US-based trained staff</li></ul><a class="link" href="<?php echo esc_url(executel_url('services')); ?>">See live answering →</a></div>
    </div>
  </div>
</section>

<section class="alt">
  <div class="wrap split">
    <div class="reveal">
      <span class="eyebrow">Overflow in action</span>
      <h2>Drag the slider. Watch AI absorb the surge.</h2>
      <p class="lead" style="margin-top:16px">Each bar is a block of the day. Blue is handled by live agents up to your staffed capacity. Purple is the overflow AI picks up.</p>
      <ul class="ticks">
        <li>Set the threshold: queue length, wait time or concurrent calls</li>
        <li>AI answers with the same greeting and brand voice</li>
        <li>Complex or sensitive calls can still be routed to a human</li>
        <li>Full transcripts and summaries for every AI-handled call</li>
      </ul>
    </div>
    <div class="vol reveal">
      <div class="vol-row">
        <div class="bar" data-v="30"><span class="ai"></span><span class="h"></span></div>
        <div class="bar" data-v="45"><span class="ai"></span><span class="h"></span></div>
        <div class="bar" data-v="70"><span class="ai"></span><span class="h"></span></div>
        <div class="bar" data-v="95"><span class="ai"></span><span class="h"></span></div>
        <div class="bar" data-v="80"><span class="ai"></span><span class="h"></span></div>
        <div class="bar" data-v="55"><span class="ai"></span><span class="h"></span></div>
        <div class="bar" data-v="65"><span class="ai"></span><span class="h"></span></div>
        <div class="bar" data-v="90"><span class="ai"></span><span class="h"></span></div>
        <div class="bar" data-v="50"><span class="ai"></span><span class="h"></span></div>
        <div class="bar" data-v="25"><span class="ai"></span><span class="h"></span></div>
      </div>
      <div class="vol-legend"><span><i style="background:var(--brand)"></i>Live agents</span><span><i style="background:var(--brand2)"></i>AI overflow</span></div>
      <div style="margin-top:22px">
        <label for="volSlider" style="display:flex;justify-content:space-between;font-size:.9rem;color:var(--muted)"><span>Live agent capacity</span><b id="volLabel" style="color:#fff"></b></label>
        <input id="volSlider" type="range" min="20" max="100" value="60" style="width:100%;margin-top:10px;accent-color:#8b5cf6">
      </div>
      <p id="volNote" style="margin-top:14px;font-size:.92rem;color:var(--ok)"></p>
      <p style="margin-top:8px;font-size:.78rem;color:var(--muted)">Illustrative demo with sample data.</p>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="sec-head c reveal"><span class="eyebrow">Built for peaks</span><h2>When volume spikes, you don't</h2></div>
    <div class="grid g4">
      <div class="card reveal"><div class="ico">📣</div><h3>Campaigns</h3><p>TV, radio and direct-response bursts that flood phones in minutes.</p></div>
      <div class="card reveal"><div class="ico">🌪️</div><h3>Emergencies</h3><p>Weather events, outages and recalls with sudden call surges.</p></div>
      <div class="card reveal"><div class="ico">🗓️</div><h3>Seasonal rush</h3><p>Open enrollment, tax season, holidays and back-to-school.</p></div>
      <div class="card reveal"><div class="ico">🌙</div><h3>Lean hours</h3><p>Humans by day, AI backup for nights, lunch breaks and weekends.</p></div>
    </div>
  </div>
</section>

<section class="alt">
  <div class="wrap">
    <div class="sec-head c reveal"><span class="eyebrow">Why hybrid</span><h2>The reliability of people, the elasticity of AI</h2></div>
    <div class="grid g3">
      <div class="card reveal"><h3>No abandoned calls</h3><p>Callers never wait in a queue or reach voicemail when your agents are all busy.</p></div>
      <div class="card reveal"><h3>Right-sized cost</h3><p>Keep staffing steady and let AI absorb peaks instead of paying for idle capacity.</p></div>
      <div class="card reveal"><h3>Seamless handoff</h3><p>AI captures context and can transfer to a live agent with a summary, so callers don't repeat themselves.</p></div>
    </div>
  </div>
</section>

<section id="faq">
  <div class="wrap" style="max-width:820px">
    <div class="sec-head c reveal"><span class="eyebrow">FAQ</span><h2>Common questions</h2></div>
    <details><summary>How does AI know when to step in?</summary><p>We set a trigger with you, such as number of waiting callers, wait time, or concurrent calls. When it's crossed, overflow calls route to AI automatically.</p></details>
    <details><summary>Can calls move from AI to a person?</summary><p>Yes. Escalation rules transfer a call to a live agent with a summary when a caller asks or when the topic is sensitive.</p></details>
    <details><summary>Do I need a new phone number?</summary><p>No. Forward your existing number and we handle the routing.</p></details>
    <details><summary>Is there a trial?</summary><p>Yes, Executel offers a customized 7-day trial with no contract and no credit card.</p></details>
  </div>
</section>

<section id="demo" style="padding-top:0">
  <div class="wrap"><div class="cta reveal">
    <h2>Never lose a call to a busy signal again</h2>
    <p>Tell us your call patterns and we'll design the right human and AI mix.</p>
    <div class="actions"><a class="btn primary" href="<?php echo esc_url(executel_url('free-trial')); ?>">Start free trial</a><a class="btn ghost" href="<?php echo esc_url(executel_url('contact')); ?>">Contact us</a></div>
  <p class="cta-phone">Or call <a href="tel:8005627505">800-562-7505</a></p>
  </div></div>
</section>
</main>
<?php get_footer(); ?>
