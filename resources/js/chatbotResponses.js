export const kayiseChatbotResponses = [
  {
    intent: "greeting",
    questions: ["hi", "hello", "hey", "good morning", "good afternoon", "good evening"],
    response:
      "Hello. I am the KAYISE IT assistant. I can help with our services, training programs, certification, opportunities, blogs, gallery, partnerships, and contact details."
  },
  {
    intent: "services",
    questions: [
      "what services does kayise it offer",
      "what services do you offer",
      "services",
      "what can kayise it do",
      "website development",
      "it consulting",
      "cyber security training",
      "microsoft office training",
      "computer productivity"
    ],
    response:
      "KAYISE IT offers drone building training, ICT skills training, 4IR technology training, cyber security training, Microsoft Office productivity training, website development, and IT consulting."
  },
  {
    intent: "drone_training",
    questions: [
      "do you offer drone training",
      "drone training",
      "drone workshop",
      "can i learn drones",
      "drone building course south africa",
      "build a drone course"
    ],
    response:
      "Yes. KAYISE IT offers practical drone building training in South Africa. The course includes hands-on assembly, testing, and STEM-based learning for schools and institutions."
  },
  {
    intent: "school_ict_training",
    questions: [
      "do you provide ict training for schools",
      "ict training for schools",
      "school training",
      "technology training for schools",
      "ict training for tvet colleges",
      "ict skills training"
    ],
    response:
      "Yes. We provide ICT skills training for schools and TVET colleges, including practical digital literacy and industry-relevant technology skills."
  },
  {
    intent: "fourir_training",
    questions: [
      "4ir",
      "4ir skills training",
      "fourth industrial revolution",
      "industry 4.0 training"
    ],
    response:
      "KAYISE IT offers 4IR skills training to prepare learners and teams for modern digital environments, innovation, and technology-enabled work."
  },
  {
    intent: "training_skills_page",
    questions: [
      "training and skills",
      "training & skills",
      "courses",
      "what courses do you offer",
      "training programs"
    ],
    response:
      "Our Training & Skills page includes ICT Skills Training, Build a Drone Course, Microsoft Office Training, Computer Productivity, Cyber Security Training, and Entrepreneurship Training."
  },
  {
    intent: "website_and_consulting",
    questions: [
      "website development",
      "build website",
      "it consulting",
      "technology consulting"
    ],
    response:
      "We provide professional website development and IT consulting to help organizations improve digital visibility, operations, and technology planning."
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
      "You can partner with KAYISE IT through training delivery, skills development programs, sponsorship, or project collaboration. We actively work with schools, businesses, and government institutions."
  },
  {
    intent: "contact",
    questions: [
      "how do i contact kayise it",
      "contact kayise it",
      "how can i contact you",
      "phone number",
      "email address",
      "where are you located",
      "location",
      "address"
    ],
    response:
      "You can contact KAYISE IT at info@kayiseit.co.za, call +27 87 702 2625 or +27 12 345 6789, or use the Contact page form. Our office is Suite 2, 2nd Floor, Nelbro Building, 39B Brown Street, Mbombela."
  },
  {
    intent: "location",
    questions: [
      "where is kayise it located",
      "where is kayiseit located",
      "where are you located",
      "where is your office",
      "location of kayise",
      "kayise location",
      "physical address"
    ],
    response:
      "KAYISE IT is located at Suite 2, 2nd Floor, Nelbro Building, 39B Brown Street, Mbombela."
  },
  {
    intent: "certification",
    questions: [
      "certificate",
      "certification",
      "lms certification",
      "download certificate"
    ],
    response:
      "You can request an LMS certificate on the Certificate page. Use your learner details there and follow the prompts for verification and download."
  },
  {
    intent: "opportunities",
    questions: [
      "opportunities",
      "internship",
      "programs",
      "learnership",
      "jobs"
    ],
    response:
      "Please check the Opportunities page for current programs and openings. You can also use the Contact page to ask about available opportunities and eligibility."
  },
  {
    intent: "blogs_and_gallery",
    questions: [
      "blogs",
      "blog",
      "news",
      "gallery",
      "photos",
      "portfolio"
    ],
    response:
      "You can view insights and updates on our Blogs page and browse project visuals on our Gallery page."
  },
  {
    intent: "about",
    questions: [
      "about",
      "who is kayise it",
      "company",
      "about kayise"
    ],
    response:
      "KAYISE IT is a South African technology partner focused on practical ICT services, digital solutions, and skills development for education and business sectors."
  },
  {
    intent: "leadership",
    questions: [
      "who is the founder of kayise it",
      "who is the founder of kayiseit",
      "who is the director of kayise it",
      "who is the director of kayiseit",
      "founder and director",
      "who owns kayise it",
      "who owns kayiseit"
    ],
    response:
      "Leadership details are shared through official KAYISE IT channels. Please contact info@kayiseit.co.za or call +27 87 702 2625 for confirmed founder and director information."
  }
];

export const kayiseFallbackResponse =
  "I can help with public website information such as services, training, opportunities, certification, blogs, gallery, and contact details. If you need more help, please use the Contact page or email info@kayiseit.co.za.";

export const kayiseConfidentialResponse =
  "I cannot share confidential or internal information. I can only assist with public information available on the KAYISE IT website.";

const confidentialKeywords = [
  "password",
  "admin login",
  "credentials",
  "secret",
  "internal",
  "private",
  "confidential",
  "database",
  "sql",
  "server key",
  "api key",
  "token",
  "source code",
  "financial statement",
  "salary",
  "customer list",
  "user data"
];

export function getKayiseChatbotResponse(userMessage = "") {
  const normalized = userMessage.toLowerCase().trim();

  if (!normalized) {
    return kayiseFallbackResponse;
  }

  const asksConfidential = confidentialKeywords.some((keyword) => normalized.includes(keyword));
  if (asksConfidential) {
    return kayiseConfidentialResponse;
  }

  for (const item of kayiseChatbotResponses) {
    const matched = item.questions.some((q) => normalized.includes(q));
    if (matched) {
      return item.response;
    }
  }

  return kayiseFallbackResponse;
}
