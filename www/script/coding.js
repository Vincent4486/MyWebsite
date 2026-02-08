// Fetch and display GitHub repositories
async function loadGitHubProjects() {
    const username = 'Vincent4486';
    const apiUrl = `https://api.github.com/users/${username}/repos`;
    
    try {
        const response = await fetch(apiUrl);
        
        if (!response.ok) {
            throw new Error(`GitHub API returned status ${response.status}`);
        }
        
        const repos = await response.json();
        
        // Sort repos by updated date (most recent first)
        repos.sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at));
        
        // Get the container where projects will be inserted
        const container = document.getElementById('projects-container');
        container.innerHTML = ''; // clear previous content on language change
        
        repos.forEach((repo, index) => {
            // Determine project state based on last update
            const lastUpdate = new Date(repo.updated_at);
            const now = new Date();
            const daysSinceUpdate = (now - lastUpdate) / (1000 * 60 * 60 * 24);
            
            let stateClass, stateKey;
            if (daysSinceUpdate < 30) {
                stateClass = 'coding-project-state-active';
                stateKey = 'coding.stateActive';
            } else if (daysSinceUpdate < 180) {
                stateClass = 'coding-project-state-done';
                stateKey = 'coding.stateDone';
            } else {
                stateClass = 'coding-project-state-deprecated';
                stateKey = 'coding.stateDeprecated';
            }
            
            // Create project element
            const projectDiv = document.createElement('div');
            projectDiv.className = 'coding-project-element';
            
            const title = document.createElement('p');
            title.className = 'coding-project-title';
            title.textContent = repo.name;
            
            // Add forked label if applicable
            const forkedLabel = document.createElement('label');
            if (repo.fork) {
                forkedLabel.className = 'coding-project-state-done';
                forkedLabel.textContent = i18n.t('coding.stateForked');
                forkedLabel.style.marginLeft = '0%';
            }
            
            const state = document.createElement('label');
            state.className = stateClass;
            state.textContent = i18n.t(stateKey);
            
            const description = document.createElement('p');
            description.className = 'coding-project-description';
            description.textContent = repo.description || i18n.t('coding.noDescription');
            
            const link = document.createElement('a');
            link.className = 'coding-project-link';
            link.href = repo.html_url;
            link.textContent = i18n.t('coding.githubRepo');
            link.target = '_blank';
            
            // Append elements to project div
            projectDiv.appendChild(title);
            if (repo.fork) {
                projectDiv.appendChild(forkedLabel);
            }
            projectDiv.appendChild(state);
            projectDiv.appendChild(description);
            projectDiv.appendChild(link);
            
            // Add to container
            container.appendChild(projectDiv);
            
            // Add horizontal rule between projects (except after the last one)
            if (index < repos.length - 1) {
                const hr = document.createElement('hr');
                container.appendChild(hr);
            }
        });
    } catch (error) {
        console.error('Error fetching GitHub repositories:', error);
        const container = document.getElementById('projects-container');
        container.innerHTML = '<p class="main-text">' + i18n.t('coding.errorLoading') + '</p>';
    }
}

// Load when i18n is ready (translations available); reload on language change
document.addEventListener('i18nReady', loadGitHubProjects);
document.addEventListener('languageChanged', loadGitHubProjects);
