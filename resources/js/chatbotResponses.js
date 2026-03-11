export const kayiseChatbotResponses = [
  {
    intent: "services",
    questions: [
      "what services does kayise it offer",
      "what services do you offer",
      "services",
      "what can kayise it do"
    ],
    response:
      "Kayise IT offers software development, web development, IT consulting, digital transformation support, and technology training programs tailored to business and education needs."
  },
  {
    intent: "drone_training",
    questions: [
      "do you offer drone training",
      "drone training",
      "drone workshop",
      "can i learn drones"
    ],
    response:
      "Yes. Kayise IT offers practical drone workshop training, including hands-on sessions for learners and schools."
  },
  {
    intent: "school_ict_training",
    questions: [
      "do you provide ict training for schools",
      "ict training for schools",
      "school training",
      "technology training for schools"
    ],
    response:
      "Yes. We provide ICT and 4IR-focused training for schools, including digital skills, robotics, and practical technology programs."
  },
  {
    intent: "partnership",
    questions: [
      "how can i partner with kayise it",
      "partner with kayise it",
      "become a partner",
      "partnership opportunities"
    ],
    response:
      "You can partner with Kayise IT through skills development, training, sponsorship, or project collaboration. Please contact us with your proposal and we will guide you through the next steps."
  },
  {
    intent: "contact",
    questions: [
      "how do i contact kayise it",
      "contact kayise it",
      "how can i contact you",
      "phone number",
      "email address"
    ],
    response:
      "You can contact Kayise IT at info@kayiseit.co.za or call +27 87 702 2625. You can also use the contact form on the Contact page."
  }
];

export const kayiseFallbackResponse =
  "Thank you for your message. Please visit our Contact page or email info@kayiseit.co.za and our team will assist you shortly.";

export function getKayiseChatbotResponse(userMessage = "") {
  const normalized = userMessage.toLowerCase().trim();

  if (!normalized) {
    return kayiseFallbackResponse;
  }

  for (const item of kayiseChatbotResponses) {
    const matched = item.questions.some((q) => normalized.includes(q));
    if (matched) {
      return item.response;
    }
  }

  return kayiseFallbackResponse;
}
