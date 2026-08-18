/**
 * GBEST / GBTech - AI & Deep Tech Interactive Simulator
 * Interactive playground demonstrating BERT NLP querying, Student Performance Prediction,
 * and AI Text Detection simulations in real-time.
 */

document.addEventListener('DOMContentLoaded', () => {
  const aiInput = document.getElementById('aiDemoInput');
  const aiRunBtn = document.getElementById('aiDemoRunBtn');
  const aiOutputTerminal = document.getElementById('aiTerminalOutput');
  const aiDemoPresets = document.querySelectorAll('.ai-demo-preset');

  if (!aiOutputTerminal) return;

  const responses = {
    bert: {
      tokens: 42,
      latency: '28ms',
      confidence: '99.4%',
      output: `[BERT-NLP-MODEL] Analyzing query semantics...\n> Embeddings projected: 768-dim tensor\n> Intent Classification: Departmental Course Registration & Prerequisite Query\n> Matched Entity: CSC 401 (Artificial Intelligence & Neural Nets)\n> System Response: "CSC 401 requires completion of CSC 301 and MTH 201 with minimum grade C. Registration closes on Friday 4:00 PM."\n> Confidence Score: 0.994 | Status: RESOLVED`
    },
    predict: {
      tokens: 35,
      latency: '18ms',
      confidence: '96.8%',
      output: `[STUDENT-PERFORMANCE-PREDICTOR] Feature vectors extracted...\n> Input: Attendance (94%), Mid-Term (88%), Quiz Avg (91%), Assignment (100%)\n> Random Forest Regression + Neural Regressor Output: Expected CGPA Projection: 4.82 / 5.00 (First Class Honors probability: 97.2%)\n> Recommendation: Candidate recommended for departmental academic honors.`
    },
    detector: {
      tokens: 58,
      latency: '34ms',
      confidence: '98.1%',
      output: `[AI-TEXT-DETECTOR] Perplexity & Burstiness Analysis Complete...\n> Linguistic Perplexity: 14.2 (Low variance indicates synthetic generation)\n> Sentence Structure Burstiness: Uniform ngram distribution\n> Result: 94.7% AI Generated (Synthesized via GPT-4/LLM Pipeline)\n> Flagged segments highlighted in token matrix.`
    },
    diabetes: {
      tokens: 46,
      latency: '22ms',
      confidence: '98.9%',
      output: `[HEALTH-AI-ASSISTANT] Processing patient query...\n> Clinical Entity Extraction: Fasting Glucose (148 mg/dL), Post-meal Spikes\n> Risk Stratification: Pre-prandial elevation noted. Recommended lifestyle adjustment & endocrinologist follow-up.\n> Dietary Advisory: Low Glycemic Index protocol suggested.\n> Disclaimer: Educational AI Assistant output. Not a substitute for formal medical prescription.`
    }
  };

  const runSimulation = (mode) => {
    aiOutputTerminal.innerHTML = '<span style="color: #F59E0B;">> Initializing Neural Pipeline... Processing tensor tokens...</span>';
    
    if (aiRunBtn) {
      aiRunBtn.disabled = true;
      aiRunBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processing...';
    }

    setTimeout(() => {
      const data = responses[mode] || responses.bert;
      aiOutputTerminal.innerHTML = `<pre style="white-space: pre-wrap; font-family: var(--font-mono); color: #A7F3D0;">${data.output}</pre>`;
      
      const latencyBadge = document.getElementById('aiLatencyBadge');
      const confidenceBadge = document.getElementById('aiConfidenceBadge');
      if (latencyBadge) latencyBadge.textContent = data.latency;
      if (confidenceBadge) confidenceBadge.textContent = data.confidence;

      if (aiRunBtn) {
        aiRunBtn.disabled = false;
        aiRunBtn.innerHTML = '<i class="fa-solid fa-play"></i> Run Model Inference';
      }
    }, 700);
  };

  // Preset buttons
  aiDemoPresets.forEach(preset => {
    preset.addEventListener('click', () => {
      aiDemoPresets.forEach(p => p.classList.remove('active'));
      preset.classList.add('active');
      const mode = preset.getAttribute('data-mode');
      if (aiInput) {
        if (mode === 'bert') aiInput.value = 'What are the course prerequisites for CSC 401?';
        else if (mode === 'predict') aiInput.value = 'Predict final outcome: 94% attendance, 88% midterms, 91% quizzes';
        else if (mode === 'detector') aiInput.value = 'In the contemporary digital landscape, transformative paradigms...';
        else if (mode === 'diabetes') aiInput.value = 'My fasting blood sugar was 148 mg/dL this morning. What should I eat?';
      }
      runSimulation(mode);
    });
  });

  if (aiRunBtn) {
    aiRunBtn.addEventListener('click', () => {
      const activePreset = document.querySelector('.ai-demo-preset.active');
      const mode = activePreset ? activePreset.getAttribute('data-mode') : 'bert';
      runSimulation(mode);
    });
  }
});
